<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dokumen Asesment Awal Keperawatan IGD</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/select2.min.css') }}"/>

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

        .kbw-signature {
            width: 100%;
            height: 450px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
            position: relative;
            left: 0;
            top: 0;
            border: 1px solid;
        }

        #sig {
            opacity: 0.5;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }

        .table_isian {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian td {
        }

        .table_isian_bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_isian2 tr {
            border: 1px solid black;
            border-collapse: collapse;
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
            <form method="post" action="{{ url('e_rekam_medis/detail/verifikasi_dokumen_kunjungan') }}">
                @csrf
                <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
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
<form onsubmit="return cek_form(this)" id="form_persetujuan"
      action="{{ url('e_rekam_medis/detail/save_dokumen_asesment_awal_keperawatan_igd') }}" method="post">
    @csrf
    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
    <input type='hidden' id='hide_tgl_respon_time' name='tgl_respon_time'>
    <input type='hidden' id='hide_jam_respon_time' name='jam_respon_time'>
    <input type='hidden' id='hide_jenis_pembayaran' name='jenis_pembayaran'>
    <input type='hidden' id='hide_jenis_kasus' name='jenis_kasus'>
    <input type='hidden' id='hide_jenis_kasus_lainnya' name='jenis_kasus_lainnya'>
    <input type="hidden" id="hide_transportasi" name="transportasi">
    <input type='hidden' id='hide_rujukan_dari' name='rujukan_dari'>
    <input type='hidden' id='hide_allo_anamnesa' name='allo_anamnesa'>
    <input type='hidden' id='hide_nama' name='nama'>
    <input type='hidden' id='hide_kelamin' name='kelamin'>
    <input type='hidden' id='hide_alamat' name='alamat'>
    <input type='hidden' id='hide_agama' name='agama'>
    <input type='hidden' id='hide_agama_lain' name='agama_lain'>
    <input type='hidden' id='hide_status_pasien' name='status_pasien'>
    <input type='hidden' id='hide_hambatan_pasien' name='hambatan_pasien'>
    <input type='hidden' id='hide_jenis_hambatan_pasien' name='jenis_hambatan_pasien'>
    <input type='hidden' id='hide_ket_jenis_hambatan_pasien' name='ket_jenis_hambatan_pasien'>
    <input type='hidden' id='hide_keluhan_utama' name='keluhan_utama'>
    <input type='hidden' id='hide_airway' name='airway'>
    <input type='hidden' id='hide_airway_lain' name='airway_lain'>
    <input type='hidden' id='hide_breathing' name='breathing'>
    <input type='hidden' id='hide_breathing_lain' name='breathing_lain'>
    <input type='hidden' id='hide_pola_pernafasan' name='pola_pernafasan'>
    <input type='hidden' id='hide_pernafasan_lain' name='pernafasan_lain'>
    <input type='hidden' id='hide_circulation' name='circulation'>
    <input type='hidden' id='hide_pendarahan' name='pendarahan'>
    <input type='hidden' id='hide_pendarahan_lain' name='pendarahan_lain'>
    <input type='hidden' id='hide_luka_bakar' name='luka_bakar'>
    <input type='hidden' id='hide_crt' name='crt'>
    <input type='hidden' id='hide_kulit' name='kulit'>
    <input type='hidden' id='hide_akral' name='akral'>
    <input type='hidden' id='hide_turgor' name='turgor'>
    <input type='hidden' id='hide_skor_buka_mata' name='skor_buka_mata'>
    <input type='hidden' id='hide_skor_respon_verbal' name='skor_respon_verbal'>
    <input type='hidden' id='hide_skor_respon_motorik' name='skor_respon_motorik'>
    <input type='hidden' id='hide_e_kesadaran' name='e_kesadaran'>
    <input type='hidden' id='hide_m_kesadaran' name='m_kesadaran'>
    <input type='hidden' id='hide_v_kesadaran' name='v_kesadaran'>
    <input type='hidden' id='hide_reflek_cahaya' name='reflek_cahaya'>
    <input type='hidden' id='hide_kesadaran' name='kesadaran'>
    <input type='hidden' id='hide_diameter_pupil' name='diameter_pupil'>
    <input type='hidden' id='hide_diameter_pupil1' name='diameter_pupil1'>
    <input type='hidden' id='hide_ekstramitas_atas' name='ekstramitas_atas'>
    <input type='hidden' id='hide_ekstramitas_atas1' name='ekstramitas_atas1'>
    <input type='hidden' id='hide_ekstramitas_bawah' name='ekstramitas_bawah'>
    <input type='hidden' id='hide_ekstramitas_bawah1' name='ekstramitas_bawah1'>
    <input type='hidden' id='hide_kesadaran2' name='kesadaran2'>
    <input type='hidden' id='hide_tanda_kehidupan' name='tanda_kehidupan'>
    <input type='hidden' id='hide_jam_penentuan_kematian' name='jam_penentuan_kematian'>
    <input type='hidden' id='hide_eksposure' name='eksposure'>
    <input type='hidden' id='hide_hptp' name='hptp'>
    <input type='hidden' id='hide_tafsiran_partus' name='tafsiran_partus'>
    <input type='hidden' id='hide_perkawinan' name='perkawinan'>
    <input type='hidden' id='hide_lama_perkawinan' name='lama_perkawinan'>
    <input type='hidden' id='hide_pemeriksaan_antenatal' name='pemeriksaan_antenatal'>
    <input type='hidden' id='hide_ket_pemeriksaan_antenatal' name='ket_pemeriksaan_antenatal'>
    <input type='hidden' id='hide_riwayat_kb' name='riwayat_kb'>
    <input type='hidden' id='hide_ket_riwayat_kb' name='ket_riwayat_kb'>
    <input type='hidden' id='hide_riwayat_ginekologi' name='riwayat_ginekologi'>
    <input type='hidden' id='hide_ket_riwayat_ginekologi' name='ket_riwayat_ginekologi'>
    <input type='hidden' id='hide_riwayat_penyakit_kehamilan' name='riwayat_penyakit_kehamilan'>
    <input type='hidden' id='hide_riwayat_operasi' name='riwayat_operasi'>
    <input type='hidden' id='hide_ket_riwayat_operasi' name='ket_riwayat_operasi'>
    <input type='hidden' id='hide_tempat_riwayat_operasi' name='tempat_riwayat_operasi'>
    <input type='hidden' id='hide_komplikasi_kehamilan' name='komplikasi_kehamilan'>
    <input type='hidden' id='hide_det_komplikasi_kehamilan' name='det_komplikasi_kehamilan'>
    <input type='hidden' id='hide_ket_det_komplikasi_kehamilan' name='ket_det_komplikasi_kehamilan'>
    <input type='hidden' id='hide_riwayat_imunisasi' name='riwayat_imunisasi'>
    <input type='hidden' id='hide_g_riwayat_kehamilan' name='g_riwayat_kehamilan'>
    <input type='hidden' id='hide_p_riwayat_kehamilan' name='p_riwayat_kehamilan'>
    <input type='hidden' id='hide_a_riwayat_kehamilan' name='a_riwayat_kehamilan'>
    <input type='hidden' id='hide_hidup_riwayat_kehamilan' name='hidup_riwayat_kehamilan'>
    <input type='hidden' id='hide_kebiasaan_ibu_hamil' name='kebiasaan_ibu_hamil'>
    <input type='hidden' id='hide_obat_minum' name='obat_minum'>
    <input type='hidden' id='hide_ket_obat_minum_lain_lain' name='ket_obat_minum_lain_lain'>
    <input type='hidden' id='hide_tfu' name='tfu'>
    <input type='hidden' id='hide_tbj' name='tbj'>
    <input type='hidden' id='hide_letak' name='letak'>
    <input type='hidden' id='hide_persentase_kebidanan' name='persentase_kebidanan'>
    <input type='hidden' id='hide_ket_persentase_kebidanan' name='ket_persentase_kebidanan'>
    <input type='hidden' id='hide_kontraksi' name='kontraksi'>
    <input type='hidden' id='hide_kekuatan' name='kekuatan'>
    <input type='hidden' id='hide_lama' name='lama'>
    <input type='hidden' id='hide_gerak_janin' name='gerak_janin'>
    <input type='hidden' id='hide_bjs' name='bjs'>
    <input type='hidden' id='hide_rad_gerak_janin' name='rad_gerak_janin'>
    <input type='hidden' id='hide_pd' name='pd'>
    <input type='hidden' id='hide_oleh' name='oleh'>
    <input type='hidden' id='hide_partio' name='partio'>
    <input type='hidden' id='hide_pembukaan_servik' name='pembukaan_servik'>
    <input type='hidden' id='hide_hodge' name='hodge'>
    <input type='hidden' id='hide_tanda_persalinan' name='tanda_persalinan'>
    <input type='hidden' id='hide_tgl_kontraksi' name='tgl_kontraksi'>
    <input type='hidden' id='hide_jam_kontraksi' name='jam_kontraksi'>
    <input type='hidden' id='hide_keluar' name='keluar'>
    <input type='hidden' id='hide_keluar_darah' name='keluar_darah'>
    <input type='hidden' id='hide_keluar_air_ketuban' name='keluar_air_ketuban'>
    <input type='hidden' id='hide_keluar_lendir' name='keluar_lendir'>
    <input type='hidden' id='hide_keluar_dislokasi' name='keluar_dislokasi'>
    <input type='hidden' id='hide_anak_ke' name='anak_ke'>
    <input type='hidden' id='hide_ket_anak_ke' name='ket_anak_ke'>
    <input type='hidden' id='hide_umur_kehamilan' name='umur_kehamilan'>
    <input type='hidden' id='hide_penyakit_ibu' name='penyakit_ibu'>
    <input type='hidden' id='hide_ket_penyakit_ibu' name='ket_penyakit_ibu'>
    <input type='hidden' id='hide_riwayat_pengobatan_ibu' name='riwayat_pengobatan_ibu'>
    <input type='hidden' id='hide_riwayat_persalinan' name='riwayat_persalinan'>
    <input type='hidden' id='hide_ket_riwayat_persalinan' name='ket_riwayat_persalinan'>
    <input type='hidden' id='hide_riwayat_diagnosa_ibu' name='riwayat_diagnosa_ibu'>
    <input type='hidden' id='hide_tanggal_lahir_intranatal' name='tanggal_lahir_intranatal'>
    <input type='hidden' id='hide_kondisi_saat_lahir' name='kondisi_saat_lahir'>
    <input type='hidden' id='hide_riwayat_intranatal' name='riwayat_intranatal'>
    <input type='hidden' id='hide_ket_riwayat_intranatal' name='ket_riwayat_intranatal'>
    <input type='hidden' id='hide_cara_bersalin' name='cara_bersalin'>
    <input type='hidden' id='hide_letak_tali_pusat' name='letak_tali_pusat'>
    <input type='hidden' id='hide_tali_pusat' name='tali_pusat'>
    <input type='hidden' id='hide_ket_tali_pusat' name='ket_tali_pusat'>
    <input type='hidden' id='hide_perkembangan_anak' name='perkembangan_anak'>
    <input type='hidden' id='hide_ket_berguling' name='ket_berguling'>
    <input type='hidden' id='hide_ket_duduk' name='ket_duduk'>
    <input type='hidden' id='hide_ket_berjalan' name='ket_berjalan'>
    <input type='hidden' id='hide_ket_berdiri' name='ket_berdiri'>
    <input type='hidden' id='hide_resiko_infeksi' name='resiko_infeksi'>
    <input type='hidden' id='hide_mayor' name='mayor'>
    <input type='hidden' id='hide_minor' name='minor'>
    <input type='hidden' id='hide_kesadaran3' name='kesadaran3'>
    <input type='hidden' id='hide_ket_kesadaran3' name='ket_kesadaran3'>
    <input type='hidden' id='hide_keadaan_umum2' name='keadaan_umum2'>
    <input type='hidden' id='hide_bb2' name='bb2'>
    <input type='hidden' id='hide_uraian_kepala' name='uraian_kepala'>
    <input type='hidden' id='hide_ket_uraian_kepala' name='ket_uraian_kepala'>
    <input type='hidden' id='hide_uraian_mata' name='uraian_mata'>
    <input type='hidden' id='hide_ket_uraian_mata' name='ket_uraian_mata'>
    <input type='hidden' id='hide_uraian_tht' name='uraian_tht'>
    <input type='hidden' id='hide_ket_uraian_tht' name='ket_uraian_tht'>
    <input type='hidden' id='hide_uraian_mulut' name='uraian_mulut'>
    <input type='hidden' id='hide_ket_uraian_mulut' name='ket_uraian_mulut'>
    <input type='hidden' id='hide_uraian_leher' name='uraian_leher'>
    <input type='hidden' id='hide_ket_uraian_leher' name='ket_uraian_leher'>
    <input type='hidden' id='hide_uraian_thorax' name='uraian_thorax'>
    <input type='hidden' id='hide_ket_uraian_thorax' name='ket_uraian_thorax'>
    <input type='hidden' id='hide_uraian_payudara' name='uraian_payudara'>
    <input type='hidden' id='hide_ket_uraian_payudara' name='ket_uraian_payudara'>
    <input type='hidden' id='hide_uraian_abdomen' name='uraian_abdomen'>
    <input type='hidden' id='hide_ket_uraian_abdomen' name='ket_uraian_abdomen'>
    <input type='hidden' id='hide_uraian_urogenital' name='uraian_urogenital'>
    <input type='hidden' id='hide_ket_uraian_urogenital' name='ket_uraian_urogenital'>
    <input type='hidden' id='hide_uraian_ekstermitas' name='uraian_ekstermitas'>
    <input type='hidden' id='hide_uraian_kulit' name='uraian_kulit'>
    <input type='hidden' id='hide_uraian_jantung' name='uraian_jantung'>
    <input type='hidden' id='hide_saudara' name='saudara'>
    <input type='hidden' id='hide_ket_kandung' name='ket_kandung'>
    <input type='hidden' id='hide_ket_tiri' name='ket_tiri'>
    <input type='hidden' id='hide_tinggal_bersama' name='tinggal_bersama'>
    <input type='hidden' id='hide_ket_tinggal_lainnya' name='ket_tinggal_lainnya'>
    <input type='hidden' id='hide_bicara' name='bicara'>
    <input type='hidden' id='hide_komunikasi' name='komunikasi'>
    <input type='hidden' id='hide_emosional' name='emosional'>
    <input type='hidden' id='hide_gangguan_jiwa' name='gangguan_jiwa'>
    <input type='hidden' id='hide_tahun_gangguan_jiwa' name='tahun_gangguan_jiwa'>
    <input type='hidden' id='hide_riwayat_trauma' name='riwayat_trauma'>
    <input type='hidden' id='hide_ket_kriminal' name='ket_kriminal'>
    <input type='hidden' id='hide_perasaan' name='perasaan'>
    <input type='hidden' id='hide_wawancara' name='wawancara'>
    <input type='hidden' id='hide_spiritual' name='spiritual'>
    <input type='hidden' id='hide_kebutuhan_spiritual' name='kebutuhan_spiritual'>
    <input type='hidden' id='hide_bantuan_ibadah' name='bantuan_ibadah'>
    <input type='hidden' id='hide_riwayat_alergi' name='riwayat_alergi'>
    <input type='hidden' id='hide_riwayat_alergi1' name='riwayat_alergi1'>
    <input type='hidden' id='hide_reaksis1' name='reaksis1'>
    <input type='hidden' id='hide_riwayat_alergi2' name='riwayat_alergi2'>
    <input type='hidden' id='hide_reaksis2' name='reaksis2'>
    <input type='hidden' id='hide_riwayat_alergi3' name='riwayat_alergi3'>
    <input type='hidden' id='hide_reaksis3' name='reaksis3'>
    <input type='hidden' id='hide_nyeri' name='nyeri'>
    <input type='hidden' id='hide_sifat_nyeri' name='sifat_nyeri'>
    <input type='hidden' id='hide_kualitas_nyeri' name='kualitas_nyeri'>
    <input type='hidden' id='hide_nyeri_menjalar' name='nyeri_menjalar'>
    <input type='hidden' id='hide_ket_nyeri_menjalar' name='ket_nyeri_menjalar'>
    <input type='hidden' id='hide_skor_nyeri' name='skor_nyeri'>
    <input type='hidden' id='hide_frekuensi_nyeri' name='frekuensi_nyeri'>
    <input type='hidden' id='hide_pengaruh_nyeri' name='pengaruh_nyeri'>
    <input type='hidden' id='hide_nilai_wajah' name='nilai_wajah'>
    <input type='hidden' id='hide_nilai_kaki' name='nilai_kaki'>
    <input type='hidden' id='hide_nilai_aktifitas' name='nilai_aktifitas'>
    <input type='hidden' id='hide_nilai_menangis' name='nilai_menangis'>
    <input type='hidden' id='hide_nilai_bersuara' name='nilai_bersuara'>
    <input type='hidden' id='hide_faktor_pencetus' name='faktor_pencetus'>
    <input type='hidden' id='hide_kualitas' name='kualitas'>
    <input type='hidden' id='hide_lokasi' name='lokasi'>
    <input type='hidden' id='hide_skala_nyeri' name='skala_nyeri'>
    <input type='hidden' id='hide_lama_nyeri' name='lama_nyeri'>
    <input type='hidden' id='hide_resiko_jatuh_anak' name='resiko_jatuh_anak'>
    <input type='hidden' id='hide_resiko_jatuh_dewasa' name='resiko_jatuh_dewasa'>
    <input type='hidden' id='hide_resiko_jatuh' name='resiko_jatuh'>
    <input type='hidden' id='hide_bb_gizi' name='bb_gizi'>
    <input type='hidden' id='hide_pb_gizi' name='pb_gizi'>
    <input type='hidden' id='hide_imt_gizi' name='imt_gizi'>
    <input type='hidden' id='hide_tampak_kurus' name='tampak_kurus'>
    <input type='hidden' id='hide_penurunan_bb' name='penurunan_bb'>
    <input type='hidden' id='hide_asupan_makanan' name='asupan_makanan'>
    <input type='hidden' id='hide_hasil_skrining_gizi' name='hasil_skrining_gizi'>
    <input type='hidden' id='hide_saran_skrining_gizi' name='saran_skrining_gizi'>
    <input type='hidden' id='hide_sensorik_penglihatan' name='sensorik_penglihatan'>
    <input type='hidden' id='hide_sensorik_penciuman' name='sensorik_penciuman'>
    <input type='hidden' id='hide_sensorik_pendengaran' name='sensorik_pendengaran'>
    <input type='hidden' id='hide_kognitif_satu' name='kognitif_satu'>
    <input type='hidden' id='hide_motorik_satu' name='motorik_satu'>
    <input type='hidden' id='hide_motorik_dua' name='motorik_dua'>
    <input type='hidden' id='hide_saran_satu' name='saran_satu'>
    <input type='hidden' id='hide_saran_dua' name='saran_dua'>
    <input type='hidden' id='hide_saran_tiga' name='saran_tiga'>
    <input type='hidden' id='hide_hasil_discharge_planning' name='hasil_discharge_planning'>
    <input type='hidden' id='hide_saran_discharge_planning' name='saran_discharge_planning'>
    <textarea id="signature_status_lokasi" name="signed" style="display: none"></textarea>

    <input type='hidden' id='hide_nama_obat_satu' name='nama_obat_satu'>
    <input type='hidden' id='hide_nama_obat_dua' name='nama_obat_dua'>
    <input type='hidden' id='hide_nama_obat_tiga' name='nama_obat_tiga'>
    <input type='hidden' id='hide_nama_obat_empat' name='nama_obat_empat'>
    <input type='hidden' id='hide_nama_obat_lima' name='nama_obat_lima'>
    <input type='hidden' id='hide_nama_obat_enam' name='nama_obat_enam'>

    <input type='hidden' id='hide_jumlah_satu' name='jumlah_satu'>
    <input type='hidden' id='hide_jumlah_dua' name='jumlah_dua'>
    <input type='hidden' id='hide_jumlah_tiga' name='jumlah_tiga'>
    <input type='hidden' id='hide_jumlah_empat' name='jumlah_empat'>
    <input type='hidden' id='hide_jumlah_lima' name='jumlah_lima'>
    <input type='hidden' id='hide_jumlah_enam' name='jumlah_enam'>

    <input type='hidden' id='hide_aturan_pakai_satu' name='aturan_pakai_satu'>
    <input type='hidden' id='hide_aturan_pakai_dua' name='aturan_pakai_dua'>
    <input type='hidden' id='hide_aturan_pakai_tiga' name='aturan_pakai_tiga'>
    <input type='hidden' id='hide_aturan_pakai_empat' name='aturan_pakai_empat'>
    <input type='hidden' id='hide_aturan_pakai_lima' name='aturan_pakai_lima'>
    <input type='hidden' id='hide_aturan_pakai_enam' name='aturan_pakai_enam'>
    <input type='hidden' id='hide_tgl_satu' name='tgl_satu'>
    <input type='hidden' id='hide_tgl_dua' name='tgl_dua'>
    <input type='hidden' id='hide_tgl_tiga' name='tgl_tiga'>
    <input type='hidden' id='hide_tgl_empat' name='tgl_empat'>
    <input type='hidden' id='hide_tgl_lima' name='tgl_lima'>
    <input type='hidden' id='hide_tgl_enam' name='tgl_enam'>
    <input type='hidden' id='hide_keterangan_satu' name='keterangan_satu'>
    <input type='hidden' id='hide_keterangan_dua' name='keterangan_dua'>
    <input type='hidden' id='hide_keterangan_tiga' name='keterangan_tiga'>
    <input type='hidden' id='hide_keterangan_empat' name='keterangan_empat'>
    <input type='hidden' id='hide_keterangan_lima' name='keterangan_lima'>
    <input type='hidden' id='hide_keterangan_enam' name='keterangan_enam'>

    <input type='hidden' id='hide_masalah_keperawatan' name='masalah_keperawatan'>
    <input type='hidden' id='hide_implementasi_keperawatan' name='implementasi_keperawatan'>
    {{-- <input type='hidden' id='hide_gangguan_pernafasan' name='gangguan_pernafasan'>
    <input type='hidden' id='hide_potensi_infeksi' name='potensi_infeksi'>
    <input type='hidden' id='hide_volume_cairan' name='volume_cairan'>
    <input type='hidden' id='hide_perubahan_nutrisi' name='perubahan_nutrisi'>
    <input type='hidden' id='hide_cemas' name='cemas'>
    <input type='hidden' id='hide_perfusi_jaringan' name='perfusi_jaringan'>
    <input type='hidden' id='hide_hipertensi' name='hipertensi'> --}}

    <input type='hidden' id='hide_jam_satu' name='jam_satu'>
    <input type='hidden' id='hide_jam_dua' name='jam_dua'>
    <input type='hidden' id='hide_jam_tiga' name='jam_tiga'>
    <input type='hidden' id='hide_jam_empat' name='jam_empat'>
    <input type='hidden' id='hide_jam_lima' name='jam_lima'>
    <input type='hidden' id='hide_jam_enam' name='jam_enam'>
    <input type='hidden' id='hide_jam_tujuh' name='jam_tujuh'>
    <input type='hidden' id='hide_jam_delapan' name='jam_delapan'>
    <input type='hidden' id='hide_jam_sembilan' name='jam_sembilan'>
    <input type='hidden' id='hide_jam_sepuluh' name='jam_sepuluh'>
    <input type='hidden' id='hide_jam_sebelas' name='jam_sebelas'>
    <input type='hidden' id='hide_jam_duabelas' name='jam_duabelas'>
    <input type='hidden' id='hide_jam_tigabelas' name='jam_tigabelas'>
    <input type='hidden' id='hide_jam_empatbelas' name='jam_empatbelas'>
    <input type='hidden' id='hide_jam_limabelas' name='jam_limabelas'>
    <input type='hidden' id='hide_jam_enambelas' name='jam_enambelas'>
    <input type='hidden' id='hide_ik_satu' name='ik_satu'>
    <input type='hidden' id='hide_ik_dua' name='ik_dua'>
    <input type='hidden' id='hide_ik_tiga' name='ik_tiga'>

    {{-- <input type='hidden' id='hide_observasi_ttv' name='observasi_ttv'>
    <input type='hidden' id='hide_intake_output' name='intake_output'>
    <input type='hidden' id='hide_monitor_pernafasan' name='monitor_pernafasan'>
    <input type='hidden' id='hide_oksimetri' name='oksimetri'>
    <input type='hidden' id='hide_semi_flower' name='semi_flower'>
    <input type='hidden' id='hide_pemasangan_opa' name='pemasangan_opa'>
    <input type='hidden' id='hide_sutlon' name='sutlon'>
    <input type='hidden' id='hide_nafas_efektif' name='nafas_efektif'>
    <input type='hidden' id='hide_oksigen' name='oksigen'>
    <input type='hidden' id='hide_imobilisasi' name='imobilisasi'>
    <input type='hidden' id='hide_perawatan_luka' name='perawatan_luka'>
    <input type='hidden' id='hide_pengelolaan_nyeri' name='pengelolaan_nyeri'>
    <input type='hidden' id='hide_teknik_asepti' name='teknik_asepti'> --}}
    <input type='hidden' id='hide_liter' name='liter'>

    <input type='hidden' id='hide_tgljamsatu' name='tgljamsatu'>
    <input type='hidden' id='hide_tgljamdua' name='tgljamdua'>
    <input type='hidden' id='hide_tgljamtiga' name='tgljamtiga'>
    <input type='hidden' id='hide_tgljamempat' name='tgljamempat'>
    <input type='hidden' id='hide_tgljamlima' name='tgljamlima'>
    <input type='hidden' id='hide_tgljamenam' name='tgljamenam'>
    <input type='hidden' id='hide_tgljamtujuh' name='tgljamtujuh'>
    <input type='hidden' id='hide_tgljamdelapan' name='tgljamdelapan'>
    <input type='hidden' id='hide_tgljamsembilan' name='tgljamsembilan'>
    <input type='hidden' id='hide_tgljamsepuluh' name='tgljamsepuluh'>

    <input type='hidden' id='hide_tindakansatu' name='tindakansatu'>
    <input type='hidden' id='hide_tindakandua' name='tindakandua'>
    <input type='hidden' id='hide_tindakantiga' name='tindakantiga'>
    <input type='hidden' id='hide_tindakanempat' name='tindakanempat'>
    <input type='hidden' id='hide_tindakanlima' name='tindakanlima'>
    <input type='hidden' id='hide_tindakanenam' name='tindakanenam'>
    <input type='hidden' id='hide_tindakantujuh' name='tindakantujuh'>
    <input type='hidden' id='hide_tindakandelapan' name='tindakandelapan'>
    <input type='hidden' id='hide_tindakansembilan' name='tindakansembilan'>
    <input type='hidden' id='hide_tindakansepuluh' name='tindakansepuluh'>

    <input type='hidden' id='hide_obat_cairan_satu' name='obat_cairan_satu'>
    <input type='hidden' id='hide_obat_cairan_dua' name='obat_cairan_dua'>
    <input type='hidden' id='hide_obat_cairan_tiga' name='obat_cairan_tiga'>
    <input type='hidden' id='hide_obat_cairan_empat' name='obat_cairan_empat'>
    <input type='hidden' id='hide_obat_cairan_lima' name='obat_cairan_lima'>
    <input type='hidden' id='hide_obat_cairan_enam' name='obat_cairan_enam'>
    <input type='hidden' id='hide_obat_cairan_tujuh' name='obat_cairan_tujuh'>
    <input type='hidden' id='hide_obat_cairan_delapan' name='obat_cairan_delapan'>
    <input type='hidden' id='hide_obat_cairan_sembilan' name='obat_cairan_sembilan'>
    <input type='hidden' id='hide_obat_cairan_sepuluh' name='obat_cairan_sepuluh'>

    <input type='hidden' id='hide_dosis_satu' name='dosis_satu'>
    <input type='hidden' id='hide_dosis_dua' name='dosis_dua'>
    <input type='hidden' id='hide_dosis_tiga' name='dosis_tiga'>
    <input type='hidden' id='hide_dosis_empat' name='dosis_empat'>
    <input type='hidden' id='hide_dosis_lima' name='dosis_lima'>
    <input type='hidden' id='hide_dosis_enam' name='dosis_enam'>
    <input type='hidden' id='hide_dosis_tujuh' name='dosis_tujuh'>
    <input type='hidden' id='hide_dosis_delapan' name='dosis_delapan'>
    <input type='hidden' id='hide_dosis_sembilan' name='dosis_sembilan'>
    <input type='hidden' id='hide_dosis_sepuluh' name='dosis_sepuluh'>

    <input type='hidden' id='hide_oral_satu' name='oral_satu'>
    <input type='hidden' id='hide_oral_dua' name='oral_dua'>
    <input type='hidden' id='hide_oral_tiga' name='oral_tiga'>
    <input type='hidden' id='hide_oral_empat' name='oral_empat'>
    <input type='hidden' id='hide_oral_lima' name='oral_lima'>
    <input type='hidden' id='hide_oral_enam' name='oral_enam'>
    <input type='hidden' id='hide_oral_tujuh' name='oral_tujuh'>
    <input type='hidden' id='hide_oral_delapan' name='oral_delapan'>
    <input type='hidden' id='hide_oral_sembilan' name='oral_sembilan'>
    <input type='hidden' id='hide_oral_sepuluh' name='oral_sepuluh'>

    <input type='hidden' id='hide_jampemberian_satu' name='jampemberian_satu'>
    <input type='hidden' id='hide_jampemberian_dua' name='jampemberian_dua'>
    <input type='hidden' id='hide_jampemberian_tiga' name='jampemberian_tiga'>
    <input type='hidden' id='hide_jampemberian_empat' name='jampemberian_empat'>
    <input type='hidden' id='hide_jampemberian_lima' name='jampemberian_lima'>
    <input type='hidden' id='hide_jampemberian_enam' name='jampemberian_enam'>
    <input type='hidden' id='hide_jampemberian_tujuh' name='jampemberian_tujuh'>
    <input type='hidden' id='hide_jampemberian_delapan' name='jampemberian_delapan'>
    <input type='hidden' id='hide_jampemberian_sembilan' name='jampemberian_sembilan'>
    <input type='hidden' id='hide_jampemberian_sepuluh' name='jampemberian_sepuluh'>
</form>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif
@if(Session::has('gagal'))
    <div class="alert alert-danger">{{Session::get('gagal')}}</div>
@endif
@if(Session::has('sukses'))
    <div class="alert alert-success">{{Session::get('sukses')}}</div>
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
        <table id="tabel_kop_identitas" style="border-collapse: collapse; font-size: 14px;">
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
                <td>{{ $layanan->kelamin == 0 ? "Laki-Laki" : "Perempuan" }}</td>
            </tr>
            <tr>
                <td style="width: 40%;">NIK</td>
                <td style="padding-left:10px; padding-right:10px"> :</td>
                <td>{{ $layanan->ktp }}</td>
            </tr>
        </table>
    </div>
</div>
<div style="margin-top: -17px;">
    <div class="row" style="width: 100%; margin-left: 0;">
        <div class="col-md-12 text-center" style="background: black; padding-top: 5px">
            <h6 style="color: white">ASESMENT AWAL KEPERAWATAN IGD</h6>
        </div>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%;" class="table_isian">
            <tr>
                <td style="width: 50%; text-align: center; border-right: 1px solid">
                    Respon Time
                </td>
                <td style="width: 50%"></td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: justify; border-right: 1px solid">
                    Hari & Tanggal : 
                    {{-- {{ date('d-m-Y', strtotime($dokumen->created_at)) }} --}}
                    {{ \Carbon\Carbon::parse($dokumen->created_at)->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}
                    {{-- <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_respon_time"
                        value="@if(old('tgl_respon_time')){{ old('tgl_respon_time') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_respon_time : '' }}@endif"> --}}
                    Pukul :
                    {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                    {{-- <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_respon_time"
                        value="@if(old('jam_respon_time')){{ old('jam_respon_time') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_respon_time : '' }}@endif"> --}}
                </td>
                <td style="width: 50%; text-align: justify">
                    Umum / BPJS / Asuransi : 
                    <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="text" id="jenis_pembayaran"
                        value="@if(old('jenis_pembayaran')){{ old('jenis_pembayaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_pembayaran : '' }}@endif">
                </td>
            </tr>
            <tr style="border: 1px solid">
                <td colspan="2">
                    Jenis Kasus : 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                               {{ old('jenis_kasus') ==  'bedah' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'bedah' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="bedah" name="radio_jenis_kasus"> Bedah, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                               {{ old('jenis_kasus') ==  'trauma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'trauma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="trauma" name="radio_jenis_kasus" class="ml-4"> Trauma, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                               {{ old('jenis_kasus') ==  'interne' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'interne' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="interne" name="radio_jenis_kasus" class="ml-4"> Interne,
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                               {{ old('jenis_kasus') ==  'tht' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'tht' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tht" name="radio_jenis_kasus" class="ml-4"> THT, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                           {{ old('jenis_kasus') ==  'anak' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'anak' ? 'checked' : '') : '' }}
                       @endif
                       type="radio" value="anak" name="radio_jenis_kasus" class="ml-4"> Anak, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                           {{ old('jenis_kasus') ==  'mata' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'mata' ? 'checked' : '') : '' }}
                       @endif
                       type="radio" value="mata" name="radio_jenis_kasus" class="ml-4"> Mata, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                           {{ old('jenis_kasus') ==  'neonatus' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'neonatus' ? 'checked' : '') : '' }}
                       @endif
                       type="radio" value="neonatus" name="radio_jenis_kasus" class="ml-4"> Neonatus, 
                    <input onclick="cek_radio_jenis_kasus()" @if(old('jenis_kasus'))
                           {{ old('jenis_kasus') ==  'lainnya' ? 'checked' : '' }}
                       @else
                           {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'lainnya' ? 'checked' : '') : '' }}
                       @endif
                       type="radio" value="lainnya" name="radio_jenis_kasus" class="ml-4"> Lainnya
                    <input type="text" readonly
                        value="@if(old('jenis_kasus_lainnya')){{ old('jenis_kasus_lainnya') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus_lainnya : '' }}@endif"
                        id="jenis_kasus_lainnya" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('jenis_kasus'))
                            {{ old('jenis_kasus') ==  'lainnya' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_kasus == 'lainnya' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            {{-- <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            Transportasi ke IGD <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-10">
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                                    {{ old('transportasi') == 'ambulance' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'ambulance' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="ambulance" name="radio_transportasi"> Ambulance, 
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                                    {{ old('transportasi') ==  'kendaraan_pribadi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'kendaraan_pribadi' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="kendaraan_pribadi" name="radio_transportasi" class="ml-4"> Kendaraan Pribadi, 
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                                    {{ old('transportasi') ==  'datang_sendiri' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'datang_sendiri' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="datang_sendiri" name="radio_transportasi" class="ml-4"> Datang Sendiri,
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                               {{ old('transportasi') ==  'rujukan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'rujukan' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="rujukan" name="radio_transportasi"> Rujukan, dari 
                            <input type="text" readonly
                                value="@if(old('rujukan_dari')){{ old('rujukan_dari') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->rujukan_dari : '' }}@endif"
                                id="rujukan_dari" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('transportasi'))
                                    {{ old('transportasi') ==  'rujukan' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'rujukan' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                               {{ old('transportasi') ==  'auto_anamnesa' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'auto_anamnesa' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="auto_anamnesa" name="radio_transportasi"> Auto Anamnesa
                            <input onclick="cek_radio_transportasi()" @if(old('transportasi'))
                               {{ old('transportasi') ==  'allo_anamnesa' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'allo_anamnesa' ? 'checked' : '') : '' }}
                                @endif
                                type="checkbox" value="allo_anamnesa" name="radio_transportasi" class="ml-4"> Allo Anamnesa 
                            <input type="text" readonly
                                value="@if(old('allo_anamnesa')){{ old('allo_anamnesa') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->allo_anamnesa : '' }}@endif"
                                id="allo_anamnesa" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('transportasi'))
                                    {{ old('transportasi') ==  'allo_anamnesa' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi == 'allo_anamnesa' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr> --}}
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            Transportasi ke IGD <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-10">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                                {{ in_array('ambulance', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="ambulance"> Ambulance
                    
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                                {{ in_array('pribadi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="pribadi" class="ml-4"> Kendaraan Pribadi
                    
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                                {{ in_array('sendiri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="sendiri" class="ml-4"> Datang Sendiri                    
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <input type="checkbox" onclick="cek_transportasi()"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi))){{ in_array('rujukan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="rujukan" class="ml-4"> Rujukan, dari    

                            <input type="text"
                            value="@if(old('rujukan_dari')){{ old('rujukan_dari') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->rujukan_dari : '' }}@endif"
                            id="rujukan_dari" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                            {{ in_array('rujukan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? '' : 'readonly' }}
                            @else
                                readonly
                            @endif>

                            <input type="checkbox" onclick="cek_transportasi()"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                                {{ in_array('auto_anamnesa', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="auto_anamnesa" class="ml-4"> Auto Anamnesa

                            <input type="checkbox" onclick="cek_transportasi()"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                                {{ in_array('allo', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? 'checked' : '' }}
                            @endif 
                            id="allo" class="ml-4"> Allo Anamnesa    

                            <input type="text"
                            value="@if(old('allo_anamnesa')){{ old('allo_anamnesa') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->allo_anamnesa : '' }}@endif"
                            id="allo_anamnesa" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)))
                            {{ in_array('allo', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->transportasi)) ? '' : 'readonly' }}
                            @else
                                readonly
                            @endif>
                        </div>
                    </div>
                </td>
            </tr>           
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td style="width: 20%;">
                    Nama
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden; width: 60%" colspan="2">
                <input type="text" class="form-control"
                                   value="@if(old('nama')){{ old('nama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama : $layanan->nama_pasien }}@endif"
                                   id="nama">
                </td>
                <td>
                    <input @if(old('kelamin'))
                               {{ old('kelamin') ==  'laki_laki' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelamin == 'laki_laki' ? 'checked' : ($layanan->kelamin == 0 ? 'checked' : '')) : ($layanan->kelamin == 0 ? 'checked' : '') }}
                           @endif
                           type="radio" value="laki_laki" name="radio_kelamin"> Laki-laki
                    <input @if(old('kelamin'))
                               {{ old('kelamin') ==  'perempuan' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kelamin == 'perempuan' ? 'checked' : ($layanan->kelamin == 1 ? 'checked' : '')) : ($layanan->kelamin == 1 ? 'checked' : '') }}
                           @endif
                           type="radio" value="perempuan" name="radio_kelamin"> Perempuan
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Alamat
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input type="text" class="form-control"
                                   value="@if(old('alamat')){{ old('alamat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->alamat : $layanan->alamat }}@endif"
                                   id="alamat">
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Agama
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'islam' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'islam' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="islam" name="radio_agama"> Islam 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'kristen' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'kristen' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="kristen" name="radio_agama" class="ml-4"> Kristen 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'katolik' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'katolik' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="katolik" name="radio_agama" class="ml-4"> Katolik 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'hindu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'hindu' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="hindu" name="radio_agama" class="ml-4"> Hindu 
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'budha' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'budha' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="budha" name="radio_agama" class="ml-4"> Budha
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'konghucu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'konghucu' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="konghucu" name="radio_agama" class="ml-4"> Konghucu
                    <input onclick="cek_radio_agama()" @if(old('agama'))
                        {{ old('agama') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_agama" class="ml-4"> 
                    <input type="text" readonly
                        value="@if(old('agama_lain')){{ old('agama_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->agama_lain : '' }}@endif"
                        id="agama_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('agama'))
                            {{ old('agama') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->agama == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Status Pasien
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input @if(old('status_pasien'))
                        {{ old('status_pasien') ==  'baru' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_pasien == 'baru' ? 'checked' : ($baru_lama <= 1 ? 'checked' : '')) : ($baru_lama <= 1 ? 'checked' : '') }}
                        @endif
                        type="radio" value="baru" name="radio_status_pasien"> Baru 
                    <input @if(old('status_pasien'))
                        {{ old('status_pasien') ==  'lama' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->status_pasien == 'lama' ? 'checked' : ($baru_lama > 1 ? 'checked' : '')) : ($baru_lama > 1 ? 'checked' : '') }}
                        @endif
                        type="radio" value="lama" name="radio_status_pasien" class="ml-4"> Lama
            </tr>
            <tr>
                <td style="width: 20%;">
                    Hambatan Pasien
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input onclick="cek_hambatan_pasien()" @if(old('hambatan_pasien'))
                        {{ old('hambatan_pasien') ==  'tidak_ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_pasien == 'tidak_ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tidak_ada" name="radio_hambatan_pasien"> Tidak Ada 
                    <input onclick="cek_hambatan_pasien()" @if(old('hambatan_pasien'))
                        {{ old('hambatan_pasien') ==  'ada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->hambatan_pasien == 'ada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ada" name="radio_hambatan_pasien" class="ml-4"> ada : 
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'bahasa' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'bahasa' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="bahasa" name="radio_jenis_hambatan_pasien" class="ml-1"> Bahasa 
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'fisik' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'fisik' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="fisik" name="radio_jenis_hambatan_pasien" class="ml-4"> Fisik 
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'tuli' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'tuli' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tuli" name="radio_jenis_hambatan_pasien" class="ml-4"> Tuli
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'bisu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'bisu' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="bisu" name="radio_jenis_hambatan_pasien" class="ml-4"> Bisu
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'buta' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'buta' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="buta" name="radio_jenis_hambatan_pasien" class="ml-4"> Buta
                    <input onclick="cek_hambatan_pasien()" @if(old('jenis_hambatan_pasien'))
                        {{ old('jenis_hambatan_pasien') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_jenis_hambatan_pasien" class="ml-4"> 
                    <input type="text" readonly
                        value="@if(old('ket_jenis_hambatan_pasien')){{ old('ket_jenis_hambatan_pasien') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_jenis_hambatan_pasien : '' }}@endif"
                        id="ket_jenis_hambatan_pasien" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('jenis_hambatan_pasien'))
                            {{ old('jenis_hambatan_pasien') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->jenis_hambatan_pasien == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="4" style="text-align: center">
                    <b>RIWAYAT KESEHATAN</b>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Keluhan Utama
                    <span style="float: right">: </span>
                    
                </td>
                <td style="border-left: hidden" colspan="3">
                </td>
            </tr>
            <tr>
                <td style="border-top: hidden" colspan="4">
                    <textarea id="keluhan_utama" class="form-control"
                                  rows="5" class="form-control">@if(old('keluhan_utama')){{ old('keluhan_utama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keluhan_utama : '' }}@endif</textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td style="width: 20%;">
                    Airway
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input onclick="cek_radio_airway()" @if(old('airway'))
                        {{ old('airway') ==  'bebas' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'bebas' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="bebas" name="radio_airway"> Bebas 
                    <input onclick="cek_radio_airway()" @if(old('airway'))
                        {{ old('airway') ==  'hidung' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'hidung' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="hidung" name="radio_airway" class="ml-4"> Hidung / Mulut 
                    <input onclick="cek_radio_airway()" @if(old('airway'))
                        {{ old('airway') ==  'pangkal_lidah' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'pangkal_lidah' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="pangkal_lidah" name="radio_airway" class="ml-4"> Pangkal Lidah Jatuh 
                    <input onclick="cek_radio_airway()" @if(old('airway'))
                        {{ old('airway') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_airway" class="ml-4"> Lainnya, sebutkan 
                    <input type="text" readonly
                        value="@if(old('airway_lain')){{ old('airway_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->airway_lain : '' }}@endif"
                        id="airway_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('airway'))
                            {{ old('airway') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->airway == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Breathing
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'normal' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'normal' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="normal" name="radio_breathing"> Normal 
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'apnoe' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'apnoe' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="apnoe" name="radio_breathing" class="ml-4"> Apnoe
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'dispnea' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'dispnea' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dispnea" name="radio_breathing" class="ml-4"> Dispnea 
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'brandipnea' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'brandipnea' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="brandipnea" name="radio_breathing" class="ml-4"> Brandipnea 
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'retraksi_dada' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'retraksi_dada' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="retraksi_dada" name="radio_breathing" class="ml-4"> Retraksi Dana 
                    <input onclick="cek_radio_breathing()" @if(old('breathing'))
                        {{ old('breathing') ==  'lain_lain' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'lain_lain' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="lain_lain" name="radio_breathing" class="ml-4"> Lainnya
                    <input type="text" readonly
                        value="@if(old('breathing_lain')){{ old('breathing_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->breathing_lain : '' }}@endif"
                        id="breathing_lain" style="border: 0; border-bottom: 2px dotted;"
                        @if(old('breathing'))
                            {{ old('breathing') ==  'lain_lain' ? '' : 'readonly' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->breathing == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                        @endif>
            </tr>
            <tr>
                <td style="width: 20%;">
                </td>
                <td style="border-left: hidden" colspan="3">
                    <div class="row">
                        <div class="col-md-2">
                            RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                        </div>
                        <div class="col-md-10">
                            Pola Pernafasan
                            <input onclick="cek_pola_pernafasan()" @if(old('pola_pernafasan'))
                                {{ old('pola_pernafasan') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'normal' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="normal" name="radio_pola_pernafasan"> Normal 
                            <input onclick="cek_pola_pernafasan()" @if(old('pola_pernafasan'))
                                {{ old('pola_pernafasan') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="radio_pola_pernafasan" class="ml-4"> Tidak, Jelaskan 
                            <input type="text" readonly
                                value="@if(old('pernafasan_lain')){{ old('pernafasan_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pernafasan_lain : '' }}@endif"
                                id="pernafasan_lain" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('pola_pernafasan'))
                                    {{ old('pola_pernafasan') ==  'tidak' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pola_pernafasan == 'tidak' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Circulation
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <div class="row">
                        <div class="col-md-2">
                            TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                        </div>
                        <div class="col-md-2">
                            Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                        </div>
                        <div class="col-md-2">
                            <input @if(old('circulation'))
                                {{ old('circulation') ==  'teratur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->circulation == 'teratur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="teratur" name="radio_circulation"> Teratur 
                        </div>
                        <div class="col-md-2">
                            <input @if(old('circulation'))
                                {{ old('circulation') ==  'tidak_teratur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->circulation == 'tidak_teratur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_teratur" name="radio_circulation"> Tidak Teratur
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                </td>
                <td style="border-left: hidden" colspan="3">
                    <div class="row">
                        <div class="col-md-4">
                            Pendarahan / Kehilangan Cairan
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_pendarahan()" @if(old('pendarahan'))
                                {{ old('pendarahan') ==  'tidak_ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'tidak_ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_ada" name="radio_pendarahan"> Tidak Ada 
                        </div>
                        <div class="col-md-6">
                            <input onclick="cek_pendarahan()" @if(old('pendarahan'))
                                {{ old('pendarahan') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ada" name="radio_pendarahan"> Ada, Jelaskan
                            <input type="text" readonly
                                value="@if(old('pendarahan_lain')){{ old('pendarahan_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan_lain : '' }}@endif"
                                id="pendarahan_lain" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('pendarahan'))
                                    {{ old('pendarahan') ==  'ada' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pendarahan == 'ada' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid;">
                <td style="width: 20%;">
                    Luas Luka Bakar
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <input type="text" 
                        value="@if(old('luka_bakar')){{ old('luka_bakar') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->luka_bakar : '' }}@endif"
                        id="luka_bakar" style="border: 0; border-bottom: 2px dotted;"> %
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    CRT
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('crt'))
                                {{ old('crt') ==  'lebih_dua_detik' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->crt == 'lebih_dua_detik' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="lebih_dua_detik" name="radio_crt"> < 2 Detik 
                        </div>
                        <div class="col-md-2">
                            <input @if(old('crt'))
                                {{ old('crt') ==  'kurang_dua_detik' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->crt == 'kurang_dua_detik' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kurang_dua_detik" name="radio_crt"> > 2 Detik 
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-1">
                            Kulit
                            <span style="float: right">: </span>
                        </div>
                        <div class="col-md-3">
                            <input @if(old('kulit'))
                                {{ old('kulit') ==  'kering' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kulit == 'kering' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kering" name="radio_kulit"> Kering 
                            <input @if(old('kulit'))
                                {{ old('kulit') ==  'lembab' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kulit == 'lembab' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lembab" name="radio_kulit" class="ml-4"> Lembab
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    Akral
                    <span style="float: right">: </span>
                </td>
                <td style="border-left: hidden" colspan="3">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('akral'))
                                {{ old('akral') ==  'hangat' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'hangat' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="hangat" name="radio_akral"> Hangat
                        </div>
                        <div class="col-md-2">
                            <input @if(old('akral'))
                                {{ old('akral') ==  'dingin' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'dingin' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="dingin" name="radio_akral"> Dingin
                        </div>
                        <div class="col-md-2">
                            <input @if(old('akral'))
                                {{ old('akral') ==  'edema' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->akral == 'edema' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="edema" name="radio_akral"> Edema
                        </div>
                        <div class="col-md-1">
                            Turgor
                            <span style="float: right">: </span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('turgor'))
                                {{ old('turgor') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_turgor"> Normal
                            <input @if(old('turgor'))
                                {{ old('turgor') ==  'sedang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'sedang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="sedang" name="radio_turgor" class="ml-4"> Sedang
                            <input @if(old('turgor'))
                                {{ old('turgor') ==  'kurang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->turgor == 'kurang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kurang" name="radio_turgor" class="ml-4"> Kurang
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr style="text-align: center">
                <td colspan="6">
                    <b>DISABILITY / NEUROLOGI</b>
                </td>
            </tr>
            <tr style="text-align: center">
                <td colspan="6">
                    <span style="font-size: 10px">
                        Table Glasgow Coma Scale
                    </span>
                </td>
            </tr>
            <tr style="text-align: center">
                <td>
                    PARAMETER
                </td>
                <td>
                    SKOR
                </td>
                <td>
                    KETERANGAN
                </td>
                <td>
                    PARAMETER
                </td>
                <td>
                    SKOR
                </td>
                <td>
                    KETERANGAN
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <select id="skor_buka_mata" class="form-control">
                        @for($i = 1; $i<=4; $i++)
                            <option @if(old('skor_buka_mata'))
                                        {{ old('skor_buka_mata') == $i ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_buka_mata == $i ? 'selected' : '' }}
                                    @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
                <td colspan="3">
                    <select id="skor_respon_verbal" class="form-control">
                        @for($i = 1; $i<=5; $i++)
                            <option @if(old('skor_respon_verbal'))
                                        {{ old('skor_respon_verbal') == $i ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_verbal == $i ? 'selected' : '' }}
                                    @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td rowspan="4" style="text-align: center">
                    BUKA MATA
                </td>
                <td style="text-align: center">
                    4
                </td>
                <td>
                    Spontan
                </td>
                <td rowspan="5" style="text-align: center">
                    RESPON VERBAL
                </td>
                <td style="text-align: center">
                    5
                </td>
                <td>
                    Oriental Baik
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    3
                </td>
                <td>
                    Dengan Perintah
                </td>
                <td style="text-align: center">
                    4
                </td>
                <td>
                    Oriental Buruk
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    2
                </td>
                <td>
                    Pada Nyeri
                </td>
                <td style="text-align: center">
                    3
                </td>
                <td>
                    Bicara Ngacau
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    1
                </td>
                <td>
                    Tidak Ada
                </td>
                <td style="text-align: center">
                    2
                </td>
                <td>
                    Tanpa Arti
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <select id="skor_respon_motorik" class="form-control">
                        @for($i = 1; $i<=6; $i++)
                            <option @if(old('skor_respon_motorik'))
                                        {{ old('skor_respon_motorik') == $i ? 'selected' : '' }}
                                    @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_respon_motorik == $i ? 'selected' : '' }}
                                    @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </td>
                <td style="text-align: center">
                    1
                </td>
                <td>
                    Tanpa Respon
                </td>
            </tr>
            <tr>
                <td rowspan="6" style="text-align: center">
                    RESPON MOTORIK
                </td>
                <td style="text-align: center">
                    6
                </td>
                <td>
                    Menurut Pada Perintah
                </td>
                <td colspan="3" rowspan="6">
                    Hasil Nilai GCS
                    <br>
                    E : <input type="text"
                                   value="@if(old('e_kesadaran')){{ old('e_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->e_kesadaran : '' }}@endif"
                                   id="e_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                    <br>
                    M: <input type="text"
                                   value="@if(old('m_kesadaran')){{ old('m_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->m_kesadaran : '' }}@endif"
                                   id="m_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                    <br>
                    V : <input type="text"
                                   value="@if(old('v_kesadaran')){{ old('v_kesadaran') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->v_kesadaran : '' }}@endif"
                                   id="v_kesadaran" style="border: 0; border-bottom: 2px dotted;">
                    <br>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    5
                </td>
                <td>
                    Pada Rangsang Nyeri
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    4
                </td>
                <td>
                    Fleksi Menarik
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    3
                </td>
                <td>
                    Fleksi Abnormal
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    2
                </td>
                <td>
                    Ekstensi
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    1
                </td>
                <td>
                    Tanpa Respon
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    KESADARAN
                </td>
                <td style="padding-left: 10px; width: 40%">
                    Reflek Cahaya
                    <input @if(old('reflek_cahaya'))
                        {{ old('reflek_cahaya') ==  'negatif' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->reflek_cahaya == 'negatif' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="negatif" name="radio_reflek_cahaya" class="ml-4"> Negatif
                    <input @if(old('reflek_cahaya'))
                        {{ old('reflek_cahaya') ==  'positif' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->reflek_cahaya == 'positif' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="positif" name="radio_reflek_cahaya" class="ml-4"> Positif
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'compos_mentis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'compos_mentis' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="compos_mentis" name="radio_kesadaran"> Compos Mentis
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'apatis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'apatis' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="apatis" name="radio_kesadaran" class="ml-4"> Apatis
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'somnolen' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'somnolen' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="somnolen" name="radio_kesadaran" class="ml-4"> Somnolen
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'soporkoma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'soporkoma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="soporkoma" name="radio_kesadaran" class="ml-4"> Soporkoma
                    <input @if(old('kesadaran'))
                               {{ old('kesadaran') ==  'coma' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran == 'coma' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="coma" name="radio_kesadaran" class="ml-4"> Coma
                </td>
                <td style="padding-left: 10px; width: 40%">
                    Kekuatan Otot
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    Pupil <span class="ml-4"> : </span>
                    Diameter Pupil 
                    <input type="text"
                        value="@if(old('diameter_pupil')){{ old('diameter_pupil') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->diameter_pupil : '' }}@endif"
                        id="diameter_pupil" style="border: 0; border-bottom: 2px dotted;"> / 
                    <input type="text"
                        value="@if(old('diameter_pupil1')){{ old('diameter_pupil1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->diameter_pupil1 : '' }}@endif"
                        id="diameter_pupil1" style="border: 0; border-bottom: 2px dotted;">
                </td>
                <td style="padding-left: 10px; width: 40%">
                    Ekstramitas Atas <span class="ml-4"> : </span>
                    <input type="text"
                        value="@if(old('ekstramitas_atas')){{ old('ekstramitas_atas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_atas : '' }}@endif"
                        id="ekstramitas_atas" style="border: 0; border-bottom: 2px dotted; width: 50px"> / 
                    <input type="text"
                        value="@if(old('ekstramitas_atas1')){{ old('ekstramitas_atas1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_atas1 : '' }}@endif"
                        id="ekstramitas_atas1" style="border: 0; border-bottom: 2px dotted; width: 50px">
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('kesadaran2'))
                                    {{ old('kesadaran2') ==  'isokor' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'isokor' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="isokor" name="radio_kesadaran2"> Isokor
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kesadaran2'))
                                    {{ old('kesadaran2') ==  'miosis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'miosis' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="miosis" name="radio_kesadaran2"> Miosis
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kesadaran2'))
                                    {{ old('kesadaran2') ==  'anisokor' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'anisokor' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="anisokor" name="radio_kesadaran2"> Anisokor
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kesadaran2'))
                                    {{ old('kesadaran2') ==  'midriasis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran2 == 'midriasis' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="midriasis" name="radio_kesadaran2"> Midriasis
                        </div>
                    </div>
                </td>
                <td style="padding-left: 10px; width: 40%">
                    Ekstramitas Bawah <span class="ml-4"> : </span>
                    <input type="text"
                        value="@if(old('ekstramitas_bawah')){{ old('ekstramitas_bawah') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_bawah : '' }}@endif"
                        id="ekstramitas_bawah" style="border: 0; border-bottom: 2px dotted; width: 50px"> / 
                    <input type="text"
                        value="@if(old('ekstramitas_bawah1')){{ old('ekstramitas_bawah1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ekstramitas_bawah1 : '' }}@endif"
                        id="ekstramitas_bawah1" style="border: 0; border-bottom: 2px dotted; width: 50px">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    Eksposure
                </td>
                <td style="padding-left: 10px; width: 40%">
                    
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    @if ($dokumen->dokumen_asesment_awal_keperawatan_igd)
                        @if ($dokumen->dokumen_asesment_awal_keperawatan_igd->gambar_status_lokalis != '')
                            <div
                                style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis2.jpg') }}')">
                                <img style="position: relative; top:0px; opacity: 0.5;"
                                    src="{{ asset('status_lokalis/' . $dokumen->dokumen_asesment_awal_keperawatan_igd->gambar_status_lokalis) }}"
                                    alt="">
                            </div>
                        @else
                            <div
                                style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis2.jpg') }}')">
                                <div id="sig"></div>
                            </div>
                        @endif
                    @else
                        <div
                            style="background-repeat: no-repeat; width: 100%; background-image: url('{{ asset('images/status_lokalis2.jpg') }}')">
                            <div id="sig"></div>
                        </div>
                    @endif
                    {{-- <img style="position: relative; top:-180px; z-index: -1;"
                        src="{{ asset('images/status_lokalis.jpg') }}" alt=""> --}}
                    <p>Gambar lokasi</p>
                    @if ($dokumen->dokumen_asesment_awal_keperawatan_igd)
                        @if ($dokumen->dokumen_asesment_awal_keperawatan_igd->gambar_status_lokalis != '')
                            <a style="position:relative; top:0px;"
                                onclick="return confirm('Yakin gambar ulang status lokalis ?')"
                                class="btn btn-dark"
                                href="{{ url('e_rekam_medis/hapus_gambar_lokalis?dokumen=' . $dokumen->id.'&jenis_dokumen=dokumen_asesment_awal_keperawatan_igd') }}">Gambar
                                ulang</a>
                        @else
                            <button style="position:relative; top:0px;" type="button" class="btn btn-danger"
                                id="btn_clear">Clear</button>
                        @endif
                    @else
                        <button style="position:relative; top:0px;" type="button" class="btn btn-danger"
                            id="btn_clear">Clear</button>
                    @endif
                </td>
                <td style="padding-left: 10px; width: 40%" rowspan="3">
                    Tanda Kehidupan
                    <br>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)))
                        {{ in_array('death_on_arrival', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)) ? 'checked' : '' }}
                    @endif 
                    id="death_on_arrival"> Death On Arival
                    <br>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)))
                        {{ in_array('denyut_nadi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)) ? 'checked' : '' }}
                    @endif 
                    id="denyut_nadi"> Denyut nadi (-) 
                    <br>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)))
                        {{ in_array('reflek_cahaya', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)) ? 'checked' : '' }}
                    @endif 
                    id="reflek_cahaya"> Reflek Cahaya (-)
                    <br>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)))
                        {{ in_array('ekg', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_kehidupan)) ? 'checked' : '' }}
                    @endif 
                    id="ekg"> EKG Asystole
                    <br>
                    Jam Penentuan Kematian : <input type="time" style="border: hidden; border-bottom: 1px dotted"
                    value="@if(old('jam_penentuan_kematian')){{ old('jam_penentuan_kematian') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_penentuan_kematian : '' }}@endif"
                    id="jam_penentuan_kematian"> WIB
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'vulnus' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'vulnus' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="vulnus" name="radio_eksposure"> Vulnus
                        </div>
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'dislokasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'dislokasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="dislokasi" name="radio_eksposure"> Dislokasi
                        </div>
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'fraktur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'fraktur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="fraktur" name="radio_eksposure"> Fraktur
                        </div>
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'ekimosis' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'ekimosis' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ekimosis" name="radio_eksposure"> Ekimosis
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 60%">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'ekskoriasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'ekskoriasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ekskoriasi" name="radio_eksposure"> Ekskoriasi
                        </div>
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'hematoma' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'hematoma' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="hematoma" name="radio_eksposure"> Hematoma
                        </div>
                        <div class="col-md-2">
                            <input @if(old('eksposure'))
                                    {{ old('eksposure') ==  'contusio' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->eksposure == 'contusio' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="contusio" name="radio_eksposure"> Contusio
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="4" style="text-align: center">
                    <b>RIWAYAT KESEHATAN PASIEN KEBIDANAN</b>
                    {{-- <br> --}}
                    <span style="font-size: 10px; font-style: italic; font-weight: bold">(diisi oleh bidan untuk pasien persalinan)</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            Riwayat Kehamilan Sekarang
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    1. HPTP : <input type="text" style="border: hidden; border-bottom: 1px dotted"
                    value="@if(old('hptp')){{ old('hptp') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hptp : '' }}@endif"
                    id="hptp"> ,
                </td>
                <td>
                    Tafsiran Partus : <input type="text" style="border: hidden; border-bottom: 1px dotted"
                    value="@if(old('tafsiran_partus')){{ old('tafsiran_partus') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tafsiran_partus : '' }}@endif"
                    id="tafsiran_partus"> ,
                </td>
                <td>
                    Perkawinan : <input type="text" style="border: hidden; border-bottom: 1px dotted"
                    value="@if(old('perkawinan')){{ old('perkawinan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->perkawinan : '' }}@endif"
                    id="perkawinan"> Kali,
                </td>
                <td>
                    Lama : <input type="text" style="border: hidden; border-bottom: 1px dotted"
                    value="@if(old('lama_perkawinan')){{ old('lama_perkawinan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama_perkawinan : '' }}@endif"
                    id="lama_perkawinan"> tahun,
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            2. Pemeriksaan Antenatal
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                        {{ in_array('dokter', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="dokter"> Dokter
                </td>
                <td>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                        {{ in_array('bidan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="bidan"> Bidan
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                        {{ in_array('terdaftar', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="terdaftar"> Terdaftar
                </td>
                <td>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                        {{ in_array('tidak_terdaftar', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="tidak_terdaftar"> Tidak terdaftar
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                        {{ in_array('tidak_teratur', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="tidak_teratur"> Tidak teratur
                </td>
                <td>
                    <input type="checkbox" onclick="cek_pemeriksaan_antenatal()"
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal))){{ in_array('teratur', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? 'checked' : '' }}
                    @endif 
                    id="teratur" class="ml-4"> Teratur :

                    <input type="text"
                    value="@if(old('ket_pemeriksaan_antenatal')){{ old('ket_pemeriksaan_antenatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_pemeriksaan_antenatal : '' }}@endif"
                    id="ket_pemeriksaan_antenatal" style="border: 0; border-bottom: 2px dotted;"
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)))
                    {{ in_array('teratur', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemeriksaan_antenatal)) ? '' : 'readonly' }} 
                    @else
                        readonly
                    @endif>
                    kali
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            3. Riwayat KB
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('Suntik', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? 'checked' : '' }}
                            @endif 
                            id="Suntik"> Suntik 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('Pil', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? 'checked' : '' }}
                            @endif 
                            id="Pil" class="ml-4"> Pil 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('Implan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? 'checked' : '' }}
                            @endif 
                            id="Implan" class="ml-4"> Implan 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('MOW', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? 'checked' : '' }}
                            @endif 
                            id="MOW" class="ml-4"> MOW 
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onclick="cek_radio_riwayat_kb()"
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('kb_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? 'checked' : '' }}
                                @endif 
                                id="kb_lain" class="ml-4">

                            <input type="text" readonly
                                value="@if(old('ket_riwayat_kb')){{ old('ket_riwayat_kb') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_kb : '' }}@endif"
                                id="ket_riwayat_kb" style="border: 0; border-bottom: 2px dotted;"
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)))
                                {{ in_array('kb_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_kb)) ? '' : 'readonly' }} 
                                @else
                                    readonly
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            4. Riwayat Ginekologi
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)))
                                {{ in_array('infertilitas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? 'checked' : '' }}
                            @endif 
                            id="infertilitas"> Infertilitas 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)))
                                {{ in_array('anemia', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? 'checked' : '' }}
                            @endif 
                            id="anemia"> Anemia 
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)))
                                {{ in_array('infeksi_virus', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? 'checked' : '' }}
                            @endif 
                            id="infeksi_virus">  Infeksi Virus
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)))
                                {{ in_array('pms', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? 'checked' : '' }}
                            @endif 
                            id="pms"> PMS
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" onclick="cek_riwayat_ginekologi()"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi))){{ in_array('rg', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? 'checked' : '' }}
                            @endif 
                            id="rg" class="ml-4">

                            <input type="text"
                            value="@if(old('ket_riwayat_ginekologi')){{ old('ket_riwayat_ginekologi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_ginekologi : '' }}@endif"
                            id="ket_riwayat_ginekologi" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)))
                            {{ in_array('rg', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_ginekologi)) ? '' : 'readonly' }} 
                            @else
                                readonly
                            @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            5. Riwayat Penyakit Kehamilan
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Terdaftar', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Terdaftar"> Terdaftar 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Anemia', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Anemia" class="ml-4"> Anemia 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Vitium', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Vitium" class="ml-4"> Vitium Cordis 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Diabetes', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Diabetes" class="ml-4"> Diabetes 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Hipertensi" class="ml-4"> Hipertensi 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('TBC', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="TBC" class="ml-4"> TBC 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('Hepatitis', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="Hepatitis" class="ml-4"> Hepatitis 
                    <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)))
                                {{ in_array('ACA', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_penyakit_kehamilan)) ? 'checked' : '' }}
                            @endif 
                            id="ACA" class="ml-4"> ACA 
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            6. Riwayat Operasi
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input onclick="cek_radio_riwayat_operasi()" @if(old('riwayat_operasi'))
                                            {{ old('riwayat_operasi') ==  'tidak' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'tidak' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="tidak" name="radio_riwayat_operasi"> Tidak
                                </div>
                                <div class="col-md-6">
                                    <input onclick="cek_radio_riwayat_operasi()" @if(old('riwayat_operasi'))
                                            {{ old('riwayat_operasi') ==  'ya' ? 'checked' : '' }}
                                        @else
                                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? 'checked' : '') : '' }}
                                        @endif
                                        type="radio" value="ya" name="radio_riwayat_operasi"> Ya, Jenis 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            : 
                            <input type="text" readonly
                                value="@if(old('ket_riwayat_operasi')){{ old('ket_riwayat_operasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_operasi : '' }}@endif"
                                id="ket_riwayat_operasi" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_operasi'))
                                    {{ old('riwayat_operasi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                        <div class="col-md-6">
                            Tempat : 
                            <input type="text" readonly
                                value="@if(old('tempat_riwayat_operasi')){{ old('tempat_riwayat_operasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tempat_riwayat_operasi : '' }}@endif"
                                id="tempat_riwayat_operasi" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_operasi'))
                                    {{ old('riwayat_operasi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_operasi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            7. Komplikasi Kehamilan Sebelumnya
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="checkbox" 
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('komplikasi_tidak', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="komplikasi_tidak"> Tidak 
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" 
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('komplikasi_ada', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="komplikasi_ada" class="ml-4"> Ada :
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="checkbox" 
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('HAV', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="HAV" class="ml-4"> HAV
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" 
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('HPP', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="HPP" class="ml-4"> HPP
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" 
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('PEB', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="PEB" class="ml-4"> PEB/PER/Eklamasi
                                </div>
                                <div class="col-md-5">
                                    <input type="checkbox" onclick="cek_radio_det_komplikasi_kehamilan()"
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                            {{ in_array('komplikasi_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? 'checked' : '' }}
                                        @endif 
                                        id="komplikasi_lain" class="ml-4"> 
                                    <input type="text" readonly
                                        value="@if(old('ket_det_komplikasi_kehamilan')){{ old('ket_det_komplikasi_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_det_komplikasi_kehamilan : '' }}@endif"
                                        id="ket_det_komplikasi_kehamilan" style="border: 0; border-bottom: 2px dotted;"
                                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)))
                                        {{ in_array('komplikasi_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->komplikasi_kehamilan)) ? '' : 'readonly' }} 
                                        @else
                                            readonly
                                        @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            8. Riwayat Imunisasi
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="checkbox" 
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)))
                            {{ in_array('imunisasi_tidak', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)) ? 'checked' : '' }}
                        @endif 
                        id="imunisasi_tidak"> Tidak
                    <input type="checkbox" 
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)))
                            {{ in_array('imunisasi_ya', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)) ? 'checked' : '' }}
                        @endif 
                        id="imunisasi_ya" class="ml-4"> Ya
                    <input type="checkbox" 
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)))
                            {{ in_array('imunisasi_tt1', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)) ? 'checked' : '' }}
                        @endif 
                        id="imunisasi_tt1" class="ml-4"> TT1
                    <input type="checkbox" 
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)))
                            {{ in_array('imunisasi_tt2', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)) ? 'checked' : '' }}
                        @endif 
                        id="imunisasi_tt2" class="ml-4"> TT2
                    <input type="checkbox" 
                        @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)))
                            {{ in_array('imunisasi_tt3', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_imunisasi)) ? 'checked' : '' }}
                        @endif 
                        id="imunisasi_tt3" class="ml-4"> TT3
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    9. Riwayat Kehamilan, Persalinan, dan Nipas : 
                    <span class="ml-4">
                        G : 
                    </span>
                    <input type="text" value="@if(old('g_riwayat_kehamilan')){{ old('g_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->g_riwayat_kehamilan : '' }}@endif"
                        id="g_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 50px;">
                    <span class="ml-4">
                        P : 
                    </span>
                    <input type="text" value="@if(old('p_riwayat_kehamilan')){{ old('p_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->p_riwayat_kehamilan : '' }}@endif"
                        id="p_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 50px;">
                    <span class="ml-4">
                        A :
                    </span>
                    <input type="text" value="@if(old('a_riwayat_kehamilan')){{ old('a_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->a_riwayat_kehamilan : '' }}@endif"
                        id="a_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 50px;">
                    <span class="ml-4">
                        Hidup : 
                    </span>
                    <input type="text" value="@if(old('hidup_riwayat_kehamilan')){{ old('hidup_riwayat_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hidup_riwayat_kehamilan : '' }}@endif"
                        id="hidup_riwayat_kehamilan" style="border: 0; border-bottom: 2px dotted; width: 50px;">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            10. Kebiasaan Ibu Saat Hamil
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            {{-- <input onclick="cek_radio_kebiasaan_ibu_hamil()" @if(old('kebiasaan_ibu_hamil'))
                                    {{ old('kebiasaan_ibu_hamil') ==  'obat_minum' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil == 'obat_minum' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="obat_minum" name="radio_kebiasaan_ibu_hamil"> Obat - obatan yang diminum  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)))
                                    {{ in_array('obat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? 'checked' : '' }}
                                @endif 
                                id="obat"> Obat-obatan yang diminum
                        </div>
                        <div class="col-md-9">
                            :
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)))
                                {{ in_array('vitamin', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? 'checked' : '' }}
                            @endif 
                            id="vitamin"> Vitamin
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)))
                                {{ in_array('jamu', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? 'checked' : '' }}
                            @endif 
                            id="jamu"> Jamu-jamuan

                            <input type="checkbox" onclick="cek_kebiasaan_ibu_hamil()"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil))){{ in_array('lain_lain', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? 'checked' : '' }}
                            @endif 
                            id="lain_lain" class="ml-4">    

                            <input type="text"
                            value="@if(old('ket_obat_minum_lain_lain')){{ old('ket_obat_minum_lain_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_obat_minum_lain_lain : '' }}@endif"
                            id="ket_obat_minum_lain_lain" style="border: 0; border-bottom: 2px dotted;"
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)))
                            {{ in_array('rujukan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? '' : 'readonly' }}
                            @else
                                readonly
                            @endif>
                          
                        
                            {{-- <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                    {{ old('obat_minum') ==  'vitamin' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'vitamin' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="vitamin" class="radio_obat_minum" name="radio_obat_minum"> Vitamin
                            <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                    {{ old('obat_minum') ==  'jamu' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'jamu' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="jamu" class="radio_obat_minum" name="radio_obat_minum" class="ml-4"> Jamu - Jamuan
                            <input onclick="cek_radio_obat_minum()" @if(old('obat_minum'))
                                    {{ old('obat_minum') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" class="radio_obat_minum" name="radio_obat_minum" class="ml-4">
                            <input type="text" readonly --}}
                                {{-- value="@if(old('ket_obat_minum_lain_lain')){{ old('ket_obat_minum_lain_lain') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_obat_minum_lain_lain : '' }}@endif"
                                id="ket_obat_minum_lain_lain" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('obat_minum'))
                                    {{ old('obat_minum') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->obat_minum == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {{-- <input onclick="cek_radio_kebiasaan_ibu_hamil()" @if(old('kebiasaan_ibu_hamil'))
                                    {{ old('kebiasaan_ibu_hamil') ==  'merokok' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil == 'merokok' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="merokok" name="radio_kebiasaan_ibu_hamil"> Merokok --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)))
                                    {{ in_array('merokok', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->kebiasaan_ibu_hamil)) ? 'checked' : '' }}
                                @endif 
                                id="merokok"> Merokok
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            11. Pemeriksaan Kebidanan
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    TFU : 
                                    <input type="text" value="@if(old('tfu')){{ old('tfu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tfu : '' }}@endif"
                                    id="tfu" style="border: 0; border-bottom: 2px dotted; width: 70px"> cm
                                </div>
                                <div class="col-md-4">
                                    TBJ : 
                                    <input type="text" value="@if(old('tbj')){{ old('tbj') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tbj : '' }}@endif"
                                    id="tbj" style="border: 0; border-bottom: 2px dotted; width: 70px">
                                </div>
                                <div class="col-md-4">
                                    Letak : 
                                    <input type="text" value="@if(old('letak')){{ old('letak') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->letak : '' }}@endif"
                                    id="letak" style="border: 0; border-bottom: 2px dotted; width: 70px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    Presentase
                                </div>
                                <div class="col-md-5">
                                    :
                                    <input type="checkbox" 
                                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)))
                                        {{ in_array('kepala', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)) ? 'checked' : '' }}
                                    @endif 
                                    id="kepala"> Kepala
                                </div>
                                <div class="col-md-5">
                                    <input type="checkbox" 
                                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)))
                                        {{ in_array('bokong', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)) ? 'checked' : '' }}
                                    @endif 
                                    id="bokong">Bokong
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-10">
                                    <input type="checkbox" onclick="cek_persentase_kebidanan()"
                                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan))){{ in_array('penurunan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)) ? 'checked' : '' }}
                                    @endif 
                                    id="penurunan" class="ml-4"> Penurunan :

                                    <input type="text"
                                    value="@if(old('ket_persentase_kebidanan')){{ old('ket_persentase_kebidanan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_persentase_kebidanan : '' }}@endif"
                                    id="ket_persentase_kebidanan" style="border: 0; border-bottom: 2px dotted;"
                                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)))
                                    {{ in_array('penurunan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->persentase_kebidanan)) ? '' : 'readonly' }} 
                                    @else
                                        readonly
                                    @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-4">
                            Kontraksi/HIS : 
                            <input type="text" value="@if(old('kontraksi')){{ old('kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kontraksi : '' }}@endif"
                                    id="kontraksi" style="border: 0; border-bottom: 2px dotted;"> x/10,
                        </div>
                        <div class="col-md-4">
                            Kekuatan : 
                            <input type="text" value="@if(old('kekuatan')){{ old('kekuatan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kekuatan : '' }}@endif"
                                    id="kekuatan" style="border: 0; border-bottom: 2px dotted;">
                        </div>
                        <div class="col-md-4">
                            Lamanya : 
                            <input type="number" value="@if(old('lama')){{ old('lama') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama : '' }}@endif"
                                    id="lama" style="border: 0; border-bottom: 2px dotted;"> detik
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Gerak Janin : 
                            <input type="text" value="@if(old('gerak_janin')){{ old('gerak_janin') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->gerak_janin : '' }}@endif"
                                    id="gerak_janin" style="border: 0; border-bottom: 2px dotted;"> x/30 menit,
                        </div>
                        <div class="col-md-8">
                            DJJ : 
                            <input type="text" value="@if(old('bjs')){{ old('bjs') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bjs : '' }}@endif"
                                    id="bjs" style="border: 0; border-bottom: 2px dotted;"> menit :
                            <input @if(old('rad_gerak_janin'))
                                    {{ old('rad_gerak_janin') ==  'teratur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rad_gerak_janin == 'teratur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="teratur" name="rad_gerak_janin"> Teratur
                            <input @if(old('rad_gerak_janin'))
                                    {{ old('rad_gerak_janin') ==  'tidak_teratur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->rad_gerak_janin == 'tidak_teratur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_teratur" name="rad_gerak_janin" class="ml-4"> Tidak Teratur
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    PD a/l : 
                                    <input type="text" value="@if(old('pd')){{ old('pd') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pd : '' }}@endif"
                                    id="pd" style="border: 0; border-bottom: 2px dotted; width: 100px"> cm
                                </div>
                                <div class="col-md-4">
                                    Oleh : 
                                    <input type="text" value="@if(old('oleh')){{ old('oleh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oleh : '' }}@endif"
                                    id="oleh" style="border: 0; border-bottom: 2px dotted; width: 100px">
                                </div>
                                <div class="col-md-4">
                                    Portio : 
                                    <input type="text" value="@if(old('partio')){{ old('partio') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->partio : '' }}@endif"
                                    id="partio" style="border: 0; border-bottom: 2px dotted; width: 100px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    Ketuban 
                                    <span style="float: right"> : </span>
                                </div>
                                <div class="col-md-3">
                                    <input @if(old('pembukaan_servik'))
                                        {{ old('pembukaan_servik') ==  'utuh' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pembukaan_servik == 'utuh' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="utuh" name="radio_pembukaan_servik"> Utuh
                                </div>
                                <div class="col-md-3">
                                    <input @if(old('pembukaan_servik'))
                                        {{ old('pembukaan_servik') ==  'tidak' ? 'checked' : '' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pembukaan_servik == 'tidak' ? 'checked' : '') : '' }}
                                    @endif
                                    type="radio" value="tidak" name="radio_pembukaan_servik"> Tidak
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Hodge : 
                    <input type="text" value="@if(old('hodge')){{ old('hodge') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hodge : '' }}@endif"
                                    id="hodge" style="border: 0; border-bottom: 2px dotted; width: 90%">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            Tanda - Tanda Persalinan
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan)))
                                {{ in_array('mules', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan)) ? 'checked' : '' }}
                            @endif 
                            id="mules"> Mules
                            {{-- <input onclick="cek_radio_tanda_persalinan()" @if(old('tanda_persalinan'))
                                    {{ old('tanda_persalinan') ==  'mules' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'mules' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="mules" name="radio_tanda_persalinan"> Mules --}}
                        </div>
                        <div class="col-md-10">
                            <input type="checkbox" 
                            @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan)))
                                {{ in_array('tp_kontraksi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan)) ? 'checked' : '' }}
                            @endif 
                            id="tp_kontraksi"> Kontraksi

                            , mulai tanggal : 
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kontraksi"
                                value="@if(old('tgl_kontraksi')){{ old('tgl_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_kontraksi : '' }}@endif">
                            , Jam
                            <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kontraksi"
                                value="@if(old('jam_kontraksi')){{ old('jam_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_kontraksi : '' }}@endif">


                            {{-- <input onclick="cek_radio_tanda_persalinan()" @if(old('tanda_persalinan'))
                                    {{ old('tanda_persalinan') ==  'kontraksi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kontraksi" name="radio_tanda_persalinan"> Kontraksi, mulai tanggal :
                                <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="date" id="tgl_kontraksi" readonly
                                    value="@if(old('tgl_kontraksi')){{ old('tgl_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_kontraksi : '' }}@endif"
                                    @if(old('tanda_persalinan'))
                                        {{ old('tanda_persalinan') ==  'kontraksi' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? '' : 'readonly') : 'readonly' }}
                                    @endif>
                                , Jam :
                                <input style="margin-top: 5px; border: hidden; border-bottom: 1px dotted" type="time" id="jam_kontraksi" class="form-control" readonly
                                    value="@if(old('jam_kontraksi')){{ old('jam_kontraksi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_kontraksi : '' }}@endif"
                                    @if(old('tanda_persalinan'))
                                        {{ old('tanda_persalinan') ==  'kontraksi' ? '' : 'readonly' }}
                                    @else
                                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tanda_persalinan == 'kontraksi' ? '' : 'readonly') : 'readonly' }}
                                    @endif> --}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Keluar
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            {{-- <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                    {{ old('keluar') ==  'darah' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'darah' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="darah" name="radio_keluar"> --}}
                                Darah
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keluar_darah'))
                                    {{ old('keluar_darah') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_darah == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ada" name="keluar_radio_darah"> Ada
                            <input @if(old('keluar_darah'))
                                    {{ old('keluar_darah') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_darah == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="keluar_radio_darah"> Tidak
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{-- <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                    {{ old('keluar') ==  'air_ketuban' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'air_ketuban' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="air_ketuban" name="radio_keluar">  --}}
                                Air Ketuban
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keluar_air_ketuban'))
                                    {{ old('keluar_air_ketuban') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_air_ketuban == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ada" name="keluar_radio_air_ketuban"> Ada
                            <input @if(old('keluar_air_ketuban'))
                                    {{ old('keluar_air_ketuban') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_air_ketuban == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="keluar_radio_air_ketuban"> Tidak
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{-- <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                    {{ old('keluar') ==  'lendir' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'lendir' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lendir" name="radio_keluar">  --}}
                                Lendir
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keluar_lendir'))
                                    {{ old('keluar_lendir') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_lendir == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ada" name="keluar_radio_lendir"> Ada
                            <input @if(old('keluar_lendir'))
                                    {{ old('keluar_lendir') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_lendir == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="keluar_radio_lendir"> Tidak
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{-- <input onclick="cek_radio_keluar()" @if(old('keluar'))
                                    {{ old('keluar') ==  'dislokasi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar == 'dislokasi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="dislokasi" name="radio_keluar">  --}}
                                Dislokasi
                            <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input @if(old('keluar_dislokasi'))
                                    {{ old('keluar_dislokasi') ==  'ada' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_dislokasi == 'ada' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ada" name="keluar_radio_dislokasi"> Ada
                            <input @if(old('keluar_dislokasi'))
                                    {{ old('keluar_dislokasi') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->keluar_dislokasi == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="keluar_radio_dislokasi"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="4" style="text-align: center">
                    <b>RIWAYAT KESEHATAN ANAK</b>
                    {{-- <br> --}}
                    <span style="font-size: 10px; font-style: italic; font-weight: bold">(diisi pada pasien Anak/Pediatrik/Neonatus)</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            1. Riwayat Prenatal
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 30px">
                            <input type="checkbox" onchange="cek_anak_ke()" @if(isset($dokumen->formulir_triage_terintegrasi))
                                {{ in_array('anak_ke',json_decode($dokumen->formulir_triage_terintegrasi->anak_ke )) ? 'checked' : '' }}
                            @endif id="anak_ke"> Anak Ke : 
                            <input type="number" id="ket_anak_ke" readonly style="border: hidden; border-bottom: 1px dotted"
                            value="@if(old('ket_anak_ke')){{ old('ket_anak_ke') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_anak_ke : '' }}@endif"
                            id="ket_anak_ke">
                            Umur Kehamilan : 
                            <input type="number" id="umur_kehamilan" readonly style="border: hidden; border-bottom: 1px dotted"
                            value="@if(old('umur_kehamilan')){{ old('umur_kehamilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->umur_kehamilan : '' }}@endif"
                            id="umur_kehamilan"> minggu
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="padding-left: 30px">
                            Riwayat Penyakit Ibu
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 30px">
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'dm' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'dm' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="dm" name="radio_penyakit_ibu">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('dm', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="dm">
                                DM &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'hipertensi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'hipertensi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="hipertensi" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="hipertensi">
                                Hipertensi &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'jantung' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'jantung' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="jantung" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('jantung', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="jantung">
                                Jantung &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'tbc' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'tbc' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tbc" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('tbc', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="tbc">
                                TBC &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'hepb' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'hepb' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="hepb" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('hepb', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="hepb">
                                Hep B &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'asma' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'asma' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="asma" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('asma', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="asma">
                                Asma &nbsp;&nbsp;&nbsp;
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'alergi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'alergi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="alergi" name="radio_penyakit_ibu" class="ml-4">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                    {{ in_array('alergi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="alergi">
                                Alergi &nbsp;&nbsp;&nbsp;

                                <input type="checkbox" onclick="cek_penyakit_ibu()"
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu))){{ in_array('pi_riwayat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? 'checked' : '' }}
                                @endif 
                                id="pi_riwayat" class="ml-4">
                              
                                <input type="text"
                                value="@if(old('ket_penyakit_ibu')){{ old('ket_penyakit_ibu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_penyakit_ibu : '' }}@endif"
                                id="ket_penyakit_ibu" style="border: 0; border-bottom: 2px dotted;"
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)))
                                {{ in_array('pi_riwayat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu)) ? '' : 'readonly' }} 
                                @else
                                    readonly
                                @endif>
                            {{-- <input onclick="cek_radio_penyakit_ibu()" @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_penyakit_ibu" class="ml-4">
                            <input type="text" readonly
                                value="@if(old('ket_penyakit_ibu')){{ old('ket_penyakit_ibu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_penyakit_ibu : '' }}@endif"
                                id="ket_penyakit_ibu" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('penyakit_ibu'))
                                    {{ old('penyakit_ibu') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penyakit_ibu == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="padding-left: 30px">
                            Riwayat Pengobatan Ibu 
                            <span style="float: right"> : </span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="riwayat_pengobatan_ibu" readonly style="border: hidden; border-bottom: 1px dotted; width: 100%"
                                value="@if(old('riwayat_pengobatan_ibu')){{ old('riwayat_pengobatan_ibu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_pengobatan_ibu : '' }}@endif"
                                id="riwayat_pengobatan_ibu">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            2. Riwayat Persalinan
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-left: 30px">
                            Ditolong <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                    {{ old('riwayat_persalinan') ==  'dokter' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'dokter' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="dokter" name="radio_riwayat_persalinan"> Dokter
                            <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                    {{ old('riwayat_persalinan') ==  'bidan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'bidan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="bidan" name="radio_riwayat_persalinan" class="ml-4"> Bidan
                            <input onclick="cek_radio_riwayat_persalinan()" @if(old('riwayat_persalinan'))
                                    {{ old('riwayat_persalinan') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_riwayat_persalinan" class="ml-4">
                            <input type="text" readonly
                                value="@if(old('ket_riwayat_persalinan')){{ old('ket_riwayat_persalinan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_persalinan : '' }}@endif"
                                id="ket_riwayat_persalinan" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_persalinan'))
                                    {{ old('riwayat_persalinan') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_persalinan == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            3. Riwayat Intranatal
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-left: 30px">
                            Diagnosa Ibu <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="riwayat_diagnosa_ibu" style="border: hidden; border-bottom: 1px dotted; width: 100%"
                                value="@if(old('riwayat_diagnosa_ibu')){{ old('riwayat_diagnosa_ibu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_diagnosa_ibu : '' }}@endif"
                                id="riwayat_diagnosa_ibu">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-left: 30px">
                            Tanggal Lahir <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input type="date" id="tanggal_lahir_intranatal" style="border: hidden; border-bottom: 1px dotted;"
                                value="@if(old('tanggal_lahir_intranatal')){{ old('tanggal_lahir_intranatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tanggal_lahir_intranatal : '' }}@endif"
                                id="tanggal_lahir_intranatal">
                            Kondisi Saat Lahir : 
                            <input type="number" id="kondisi_saat_lahir" style="border: hidden; border-bottom: 1px dotted;"
                                value="@if(old('kondisi_saat_lahir')){{ old('kondisi_saat_lahir') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kondisi_saat_lahir : '' }}@endif"
                                id="kondisi_saat_lahir"> gram, 
                            <input onclick="cek_radio_riwayat_intranatal()" @if(old('riwayat_intranatal'))
                                    {{ old('riwayat_intranatal') ==  'aspixia' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_intranatal == 'aspixia' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="aspixia" name="radio_riwayat_intranatal" class="ml-4"> Aspixia
                            <input onclick="cek_radio_riwayat_intranatal()" @if(old('riwayat_intranatal'))
                                    {{ old('riwayat_intranatal') ==  'apgar_score' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_intranatal == 'apgar_score' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="apgar_score" name="radio_riwayat_intranatal" class="ml-4"> Apgar Score
                            <input type="text" readonly
                                value="@if(old('ket_riwayat_intranatal')){{ old('ket_riwayat_intranatal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_riwayat_intranatal : '' }}@endif"
                                id="ket_riwayat_intranatal" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('riwayat_intranatal'))
                                    {{ old('riwayat_intranatal') ==  'apgar_score' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_intranatal == 'apgar_score' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-left: 30px">
                            Cara Bersalin <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <input @if(old('cara_bersalin'))
                                    {{ old('cara_bersalin') ==  'spontan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'spontan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="spontan" name="radio_cara_bersalin"> Spontan
                            <input @if(old('cara_bersalin'))
                                    {{ old('cara_bersalin') ==  'vacum_ekstraksi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'vacum_ekstraksi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="vacum_ekstraksi" name="radio_cara_bersalin" class="ml-4"> Vacum Ekstraksi
                            <input @if(old('cara_bersalin'))
                                    {{ old('cara_bersalin') ==  'porcep_ekstaksi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'porcep_ekstaksi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="porcep_ekstaksi" name="radio_cara_bersalin" class="ml-4"> Porcep Ekstaksi
                            <input @if(old('cara_bersalin'))
                                    {{ old('cara_bersalin') ==  'sectio_caesarean' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->cara_bersalin == 'sectio_caesarean' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="sectio_caesarean" name="radio_cara_bersalin" class="ml-4"> Sectio Caesarean
                        </div>
                    </div>
                    <div class="row" style="padding-left: 30px">
                        Letak <input type="text" id="letak_tali_pusat" style="border: hidden; border-bottom: 1px dotted;"
                                value="@if(old('letak_tali_pusat')){{ old('letak_tali_pusat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->letak_tali_pusat : '' }}@endif"
                                id="letak_tali_pusat"> Tali Pusat
                        <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                    {{ old('tali_pusat') ==  'segar' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'segar' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="segar" name="radio_tali_pusat" class="ml-4"> Segar
                        <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                    {{ old('tali_pusat') ==  'layu' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'layu' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="layu" name="radio_tali_pusat" class="ml-4"> Layu
                        <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                    {{ old('tali_pusat') ==  'simpul' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'simpul' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="simpul" name="radio_tali_pusat" class="ml-4"> Simpul
                        <input onclick="cek_radio_tali_pusat()" @if(old('tali_pusat'))
                                    {{ old('tali_pusat') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_tali_pusat" class="ml-4"> 
                        <input type="text" readonly
                            value="@if(old('ket_tali_pusat')){{ old('ket_tali_pusat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tali_pusat : '' }}@endif"
                            id="ket_tali_pusat" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('tali_pusat'))
                                {{ old('tali_pusat') ==  'lain_lain' ? '' : 'readonly' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tali_pusat == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                            @endif>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            4. Status Perkembangan Anak
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-2">
                            <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berguling' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berguling' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="berguling" name="radio_perkembangan_anak"> 
                            Berguling <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="number" readonly
                                value="@if(old('ket_berguling')){{ old('ket_berguling') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berguling : '' }}@endif"
                                id="ket_berguling" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berguling' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berguling' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'duduk' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'duduk' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="duduk" name="radio_perkembangan_anak"> 
                            Duduk <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="number" readonly
                                value="@if(old('ket_duduk')){{ old('ket_duduk') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_duduk : '' }}@endif"
                                id="ket_duduk" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'duduk' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'duduk' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-2">
                            <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berjalan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berjalan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="berjalan" name="radio_perkembangan_anak"> 
                            Berjalan <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="number" readonly
                                value="@if(old('ket_berjalan')){{ old('ket_berjalan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berjalan : '' }}@endif"
                                id="ket_berjalan" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berjalan' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berjalan' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_perkembangan_anak()" @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berdiri' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berdiri' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="berdiri" name="radio_perkembangan_anak"> 
                            Berdiri <span style="float: right">:</span>
                        </div>
                        <div class="col-md-4">
                            <input type="number" readonly
                                value="@if(old('ket_berdiri')){{ old('ket_berdiri') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_berdiri : '' }}@endif"
                                id="ket_berdiri" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('perkembangan_anak'))
                                    {{ old('perkembangan_anak') ==  'berdiri' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perkembangan_anak == 'berdiri' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            5. Faktor Resiko Infeksi 
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi)))
                                    {{ in_array('resiko_infeksi_ada', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi)) ? 'checked' : '' }}
                                @endif id="resiko_infeksi_ada"> Ada
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi)))
                                    {{ in_array('resiko_infeksi_tidak', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_infeksi)) ? 'checked' : '' }}
                                @endif id="resiko_infeksi_tidak"> Tidak Ada
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            Mayor <span style="float: right">:</span>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-3">
                            {{-- <input @if(old('mayor'))
                                    {{ old('mayor') ==  'ibu_demam' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'ibu_demam' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ibu_demam" name="radio_mayor">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)))
                                    {{ in_array('ibu_demam', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)) ? 'checked' : '' }}
                                @endif id="ibu_demam">
                                Ibu Demam Lebih Dari 38<sup>o</sup>C
                        </div>
                        <div class="col-md-3">
                            {{-- <input @if(old('mayor'))
                                    {{ old('mayor') ==  'kpd' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'kpd' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="kpd" name="radio_mayor">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)))
                                    {{ in_array('kpd', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)) ? 'checked' : '' }}
                                @endif id="kpd">
                                KPD > 24 Jam
                        </div>
                        <div class="col-md-3">
                            {{-- <input @if(old('mayor'))
                                    {{ old('mayor') ==  'ketuban_hijau' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'ketuban_hijau' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ketuban_hijau" name="radio_mayor">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)))
                                    {{ in_array('ketuban_hijau', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)) ? 'checked' : '' }}
                                @endif id="ketuban_hijau">
                                Ketuban Hijau
                        </div>
                        <div class="col-md-3">
                            {{-- <input @if(old('mayor'))
                                    {{ old('mayor') ==  'vetal_distress' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor == 'vetal_distress' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="vetal_distress" name="radio_mayor">  --}}
                                <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)))
                                    {{ in_array('fetal', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->mayor)) ? 'checked' : '' }}
                                @endif id="fetal">
                                Fetal Distress
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            Minor <span style="float: right">:</span>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_satu', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_satu"> KPD > 12 Jam
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_dua', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_dua"> Aspixia
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_tiga', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_tiga"> BBLR
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_empat', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_empat"> ISK
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_lima', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_lima"> UK > 37 Jam
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_enam', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_enam"> Gemeli
                        </div>
                    </div>
                    <div class="row" style="padding-left: 20px">
                        <div class="col-md-2">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_tujuh', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_tujuh"> Keputihan
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" 
                                @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)))
                                    {{ in_array('minor_delapan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->minor)) ? 'checked' : '' }}
                                @endif id="minor_delapan"> Ibu Temperatur Lebih dari 37<sup>o</sup>C
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="4" style="text-align: center">
                    <b>PEMERIKSAAN FISIK</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-1">
                            Kesadaran
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                {{ old('kesadaran3') ==  'compos_mentis' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'compos_mentis' ? 'checked' : '') : 'checked' }}
                            @endif
                            type="radio" value="compos_mentis" name="radio_kesadaran3"> Compos Mentis
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                {{ old('kesadaran3') ==  'apatis' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'apatis' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="apatis" name="radio_kesadaran3"> Apatis
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                {{ old('kesadaran3') ==  'somnolen' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'somnolen' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="somnolen" name="radio_kesadaran3"> Somnolen
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                {{ old('kesadaran3') ==  'soporkoma' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'soporkoma' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="soporkoma" name="radio_kesadaran3"> Soporkoma
                        </div>
                        <div class="col-md-3">
                            <input onclick="cek_radio_kesadaran()" @if(old('kesadaran3'))
                                {{ old('kesadaran3') ==  'lain_lain' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'lain_lain' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="lain_lain" name="radio_kesadaran3">
                            <input type="text" readonly
                                value="@if(old('ket_kesadaran3')){{ old('ket_kesadaran3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kesadaran3 : '' }}@endif"
                                id="ket_kesadaran3" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('kesadaran3'))
                                    {{ old('kesadaran3') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kesadaran3 == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            Keadaan Umum <span style="float: right">:</span>
                        </div>
                        <div class="col-md-6">
                            {{-- <input type="text" id="keadaan_umum2" readonly style="border: hidden; border-bottom: 1px dotted; width: 100%"
                                value="@if(old('keadaan_umum2')){{ old('keadaan_umum2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keadaan_umum2 : '' }}@endif"
                                id="keadaan_umum2"> --}}
                            {{ $layanan->tanda_vital ? $layanan->tanda_vital->keadaan_umum : '....' }}
                        </div>
                        <div class="col-md-4">
                            BB : 
                            {{-- <input type="number" id="bb" readonly style="border: hidden; border-bottom: 1px dotted;"
                            value="@if(old('bb')){{ old('bb') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bb : '' }}@endif"
                            id="bb">  --}}
                            {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '....' }} Kg
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-2">
                            Tanda Vital <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-2">
                                    TD {{ $layanan->tanda_vital ? $layanan->tanda_vital->tensi : '..../....' }} mmHg
                                </div>
                                <div class="col-md-2">
                                    RR {{ $layanan->tanda_vital ? $layanan->tanda_vital->rr : '....' }} x/menit
                                </div>
                                <div class="col-md-2">
                                    Nadi {{ $layanan->tanda_vital ? $layanan->tanda_vital->nadi : '....' }} x/menit
                                </div>
                                <div class="col-md-2">
                                    Suhu {{ $layanan->tanda_vital ? $layanan->tanda_vital->suhu : '....' }} ᵒC
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="5" style="text-align: center">
                    <b>URAIAN</b>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 17%">
                    Kepala 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                    {{ old('uraian_kepala') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_kepala"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                    {{ old('uraian_kepala') ==  'benjolan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'benjolan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="benjolan" name="radio_uraian_kepala"> Benjolan
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                    {{ old('uraian_kepala') ==  'luka' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'luka' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="luka" name="radio_uraian_kepala"> Luka
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_kepala()" @if(old('uraian_kepala'))
                                    {{ old('uraian_kepala') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_kepala"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_kepala')){{ old('ket_uraian_kepala') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_kepala : '' }}@endif"
                                id="ket_uraian_kepala" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_kepala'))
                                    {{ old('uraian_kepala') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kepala == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Mata 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                    {{ old('uraian_mata') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_mata"> Normal
                        </div>
                        <div class="col-md-2">
                            Pupil : <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                    {{ old('uraian_mata') ==  'isokor' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'isokor' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="isokor" name="radio_uraian_mata"> Isoko
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                    {{ old('uraian_mata') ==  'anisokor' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'anisokor' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="anisokor" name="radio_uraian_mata"> Anisokor
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_mata()" @if(old('uraian_mata'))
                                    {{ old('uraian_mata') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_mata"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_mata')){{ old('ket_uraian_mata') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_mata : '' }}@endif"
                                id="ket_uraian_mata" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_mata'))
                                    {{ old('uraian_mata') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mata == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    THT 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                    {{ old('uraian_tht') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_tht"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                    {{ old('uraian_tht') ==  'luka' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'luka' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="luka" name="radio_uraian_tht"> Luka
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                    {{ old('uraian_tht') ==  'sumbatan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'sumbatan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="sumbatan" name="radio_uraian_tht"> Sumbatan
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_tht()" @if(old('uraian_tht'))
                                    {{ old('uraian_tht') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_tht"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_tht')){{ old('ket_uraian_tht') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_tht : '' }}@endif"
                                id="ket_uraian_tht" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_tht'))
                                    {{ old('uraian_tht') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_tht == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Mulut 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                    {{ old('uraian_mulut') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_mulut"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                    {{ old('uraian_mulut') ==  'luka' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'luka' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="luka" name="radio_uraian_mulut"> Luka
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                    {{ old('uraian_mulut') ==  'benjolan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'benjolan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="benjolan" name="radio_uraian_mulut"> Benjolan
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_mulut()" @if(old('uraian_mulut'))
                                    {{ old('uraian_mulut') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_mulut"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_mulut')){{ old('ket_uraian_mulut') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_mulut : '' }}@endif"
                                id="ket_uraian_mulut" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_mulut'))
                                    {{ old('uraian_mulut') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_mulut == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Leher 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                    {{ old('uraian_leher') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_leher"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                    {{ old('uraian_leher') ==  'luka' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'luka' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="luka" name="radio_uraian_leher"> Luka
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                    {{ old('uraian_leher') ==  'benjolan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'benjolan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="benjolan" name="radio_uraian_leher"> Benjolan
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_leher()" @if(old('uraian_leher'))
                                    {{ old('uraian_leher') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_leher"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_leher')){{ old('ket_uraian_leher') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_leher : '' }}@endif"
                                id="ket_uraian_leher" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_leher'))
                                    {{ old('uraian_leher') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_leher == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Thorax 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                    {{ old('uraian_thorax') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_thorax"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                    {{ old('uraian_thorax') ==  'luka' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'luka' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="luka" name="radio_uraian_thorax"> Luka
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                    {{ old('uraian_thorax') ==  'benjolan' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'benjolan' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="benjolan" name="radio_uraian_thorax"> Benjolan
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_thorax()" @if(old('uraian_thorax'))
                                    {{ old('uraian_thorax') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_thorax"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_thorax')){{ old('ket_uraian_thorax') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_thorax : '' }}@endif"
                                id="ket_uraian_thorax" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_thorax'))
                                    {{ old('uraian_thorax') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_thorax == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Payudara 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                    {{ old('uraian_payudara') ==  'keluar_asi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'keluar_asi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="keluar_asi" name="radio_uraian_payudara"> Keluar Asi
                        </div>
                        <div class="col-md-3">
                            <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                    {{ old('uraian_payudara') ==  'puting_tenggelam' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'puting_tenggelam' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="puting_tenggelam" name="radio_uraian_payudara"> Puting Datang / Tenggelam
                        </div>
                        <div class="col-md-3">
                            <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                    {{ old('uraian_payudara') ==  'puting_menonjol' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'puting_menonjol' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="puting_menonjol" name="radio_uraian_payudara"> Puting Menonjol
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_payudara()" @if(old('uraian_payudara'))
                                    {{ old('uraian_payudara') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_payudara"> 
                            <input type="text" readonly
                                value="@if(old('ket_uraian_payudara')){{ old('ket_uraian_payudara') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_payudara : '' }}@endif"
                                id="ket_uraian_payudara" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_payudara'))
                                    {{ old('uraian_payudara') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_payudara == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Abdomen 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_abdomen"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'asistes' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'asistes' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="asistes" name="radio_uraian_abdomen"> Asistes
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'tegang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'tegang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tegang" name="radio_uraian_abdomen"> Tegang
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'masa' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'masa' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="masa" name="radio_uraian_abdomen"> Masa
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_uraian_abdomen()" @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_abdomen"> Lainnya
                            <input type="text" readonly
                                value="@if(old('ket_uraian_abdomen')){{ old('ket_uraian_abdomen') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_abdomen : '' }}@endif"
                                id="ket_uraian_abdomen" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_abdomen'))
                                    {{ old('uraian_abdomen') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_abdomen == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Urogenital 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                    {{ old('uraian_urogenital') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_urogenital"> Normal
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                    {{ old('uraian_urogenital') ==  'tidak_normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'tidak_normal' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_normal" name="radio_uraian_urogenital"> Tidak Normal
                        </div>
                        <div class="col-md-8">
                            <input onclick="cek_radio_uraian_urogenital()" @if(old('uraian_urogenital'))
                                    {{ old('uraian_urogenital') ==  'lain_lain' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'lain_lain' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lain_lain" name="radio_uraian_urogenital">
                            <input type="text" readonly
                                value="@if(old('ket_uraian_urogenital')){{ old('ket_uraian_urogenital') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_uraian_urogenital : '' }}@endif"
                                id="ket_uraian_urogenital" style="border: 0; border-bottom: 2px dotted;"
                                @if(old('uraian_urogenital'))
                                    {{ old('uraian_urogenital') ==  'lain_lain' ? '' : 'readonly' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_urogenital == 'lain_lain' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Ekstermitas 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('uraian_ekstermitas'))
                                    {{ old('uraian_ekstermitas') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_ekstermitas"> Normal
                        </div>
                        <div class="col-md-2">
                            Atas : <input @if(old('uraian_ekstermitas'))
                                    {{ old('uraian_ekstermitas') ==  'atas_kuat' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'atas_kuat' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="atas_kuat" name="radio_uraian_ekstermitas"> Kuat
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_ekstermitas'))
                                    {{ old('uraian_ekstermitas') ==  'atas_lemah' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'atas_lemah' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="atas_lemah" name="radio_uraian_ekstermitas"> Lemah
                        </div>
                        <div class="col-md-2">
                            Bawah : <input @if(old('uraian_ekstermitas'))
                                    {{ old('uraian_ekstermitas') ==  'bawah_kuat' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'bawah_kuat' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="bawah_kuat" name="radio_uraian_ekstermitas"> Kuat
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_ekstermitas'))
                                    {{ old('uraian_ekstermitas') ==  'bawah_lemah' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_ekstermitas == 'bawah_lemah' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="bawah_lemah" name="radio_uraian_ekstermitas"> Lemah
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Kulit 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('uraian_kulit'))
                                    {{ old('uraian_kulit') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_kulit"> Normal
                        </div>
                        <div class="col-md-2">
                            Turgor : <input @if(old('uraian_kulit'))
                                    {{ old('uraian_kulit') ==  'baik' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'baik' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="baik" name="radio_uraian_kulit"> Baik
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_kulit'))
                                    {{ old('uraian_kulit') ==  'lemah' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'lemah' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="lemah" name="radio_uraian_kulit"> Lemah
                        </div>
                        <div class="col-md-2">
                            Luka : <input @if(old('uraian_kulit'))
                                    {{ old('uraian_kulit') ==  'ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ya" name="radio_uraian_kulit"> Ya
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_kulit'))
                                    {{ old('uraian_kulit') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_kulit == 'tidak' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak" name="radio_uraian_kulit"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid; width: 10%">
                    Jantung 
                </td>
                <td colspan="4" style="padding-left: 10px">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('uraian_jantung'))
                                    {{ old('uraian_jantung') ==  'normal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'normal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="normal" name="radio_uraian_jantung"> Normal
                        </div>
                        <div class="col-md-2">
                            Nyeri Dada : <input @if(old('uraian_jantung'))
                                    {{ old('uraian_jantung') ==  'ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ya" name="radio_uraian_jantung"> Ya
                        </div>
                        <div class="col-md-3">
                            <input @if(old('uraian_jantung'))
                                    {{ old('uraian_jantung') ==  'tidak_bunyi' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'tidak_bunyi' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_bunyi" name="radio_uraian_jantung"> Tidak Bunyi Jantung
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_jantung'))
                                    {{ old('uraian_jantung') ==  'mumur' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'mumur' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="mumur" name="radio_uraian_jantung"> Mumur
                        </div>
                        <div class="col-md-2">
                            <input @if(old('uraian_jantung'))
                                    {{ old('uraian_jantung') ==  'gallop' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->uraian_jantung == 'gallop' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="gallop" name="radio_uraian_jantung"> Gallop
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%;">
            <tr style="border: 1px solid">
                <td colspan="6" style="text-align: center">
                    <b>STATUS PSIKOLOGIS, SOSIAL, DAN SPIRITUAL</b>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Saudara</td>
                <td colspan="2" style="padding-left: 10px">
                    <input onclick="cek_radio_saudara()"
                           @if(old('saudara'))
                               {{ old('saudara') ==  'kandung' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'kandung' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="kandung" name="radio_saudara"> Kandung, Jumlah
                    <input type="number" readonly
                           value="@if(old('ket_kandung')){{ old('ket_kandung') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kandung : '' }}@endif"
                           id="ket_kandung" style="border: 0; border-bottom: 2px dotted;"
                    @if(old('saudara'))
                        {{ old('saudara') ==  'kandung' ? '' : 'readonly' }}
                        @else
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'kandung' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
                <td colspan="3" style="border-left: hidden">
                    <input onclick="cek_radio_saudara()"
                           @if(old('saudara'))
                               {{ old('saudara') ==  'tiri' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'tiri' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="tiri" name="radio_saudara"> Tiri, Jumlah
                    <input type="number" readonly
                           value="@if(old('ket_tiri')){{ old('ket_tiri') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tiri : '' }}@endif"
                           id="ket_tiri" style="border: 0; border-bottom: 2px dotted;"
                    @if(old('saudara'))
                        {{ old('saudara') ==  'tiri' ? '' : 'readonly' }}
                        @else
                        {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saudara == 'tiri' ? '' : 'readonly') : 'readonly' }}
                        @endif>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Tinggal Bersama</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_tinggal_bersama()"
                                   @if(old('tinggal_bersama'))
                                       {{ old('tinggal_bersama') ==  'ortu' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'ortu' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="ortu" name="radio_tinggal_bersama"> Orang Tua
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_tinggal_bersama()"
                                   @if(old('tinggal_bersama'))
                                       {{ old('tinggal_bersama') ==  'tinggal_lainnya' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'tinggal_lainnya' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tinggal_lainnya" name="radio_tinggal_bersama"> Lainnya,
                            <input type="text" value="" id="ket_tinggal_lainnya"
                                   value="@if(old('ket_tinggal_lainnya')){{ old('ket_tinggal_lainnya') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_tinggal_lainnya : '' }}@endif"
                                   style="border: 0; border-bottom: 2px dotted;"
                            @if(old('tinggal_bersama'))
                                {{ old('tinggal_bersama') ==  'tinggal_lainnya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tinggal_bersama == 'tinggal_lainnya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Bicara</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input
                                @if(old('bicara'))
                                    {{ old('bicara') ==  'jelas' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bicara == 'jelas' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="jelas" name="radio_bicara"> Jelas
                        </div>
                        <div class="col-md-4">
                            <input
                                @if(old('bicara'))
                                    {{ old('bicara') ==  'tidak_dimengerti' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bicara == 'tidak_dimengerti' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tidak_dimengerti" name="radio_bicara"> Tidak Dapat Dimengerti
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Komunikasi</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input
                                @if(old('komunikasi'))
                                    {{ old('komunikasi') ==  'verbal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komunikasi == 'verbal' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="verbal" name="radio_komunikasi"> Verbal
                        </div>
                        <div class="col-md-2">
                            <input
                                @if(old('komunikasi'))
                                    {{ old('komunikasi') ==  'non_verbal' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->komunikasi == 'non_verbal' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="non_verbal" name="radio_komunikasi"> Non Verbal
                        </div>
                    </div>
    
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Status Emosional</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input
                                @if(old('emosional'))
                                    {{ old('emosional') ==  'stabil' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'stabil' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="stabil" name="radio_emosional"> Stabil
                        </div>
                        <div class="col-md-2">
                            <input
                                @if(old('emosional'))
                                    {{ old('emosional') ==  'tenang' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'tenang' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="tenang" name="radio_emosional"> Tenang
                        </div>
                        <div class="col-md-2">
                            <input
                                @if(old('emosional'))
                                    {{ old('emosional') ==  'cemas' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'cemas' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="cemas" name="radio_emosional"> Cemas
                        </div>
                        <div class="col-md-2">
                            <input
                                @if(old('emosional'))
                                    {{ old('emosional') ==  'takut' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->emosional == 'takut' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="takut" name="radio_emosional"> Takut
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-4">Riwayat pernah mengalami gangguan jiwa</div>
                        <div>:</div>
                        <div class="col-md-1">
                            <input onclick="cek_radio_gangguan_jiwa()"
                                   @if(old('gangguan_jiwa'))
                                       {{ old('gangguan_jiwa') ==  'tidak' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_jiwa == 'tidak' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="tidak" name="radio_gangguan_jiwa"> Tidak
                        </div>
                        <div class="col-md-4">
                            <input onclick="cek_radio_gangguan_jiwa()"
                                   @if(old('gangguan_jiwa'))
                                       {{ old('gangguan_jiwa') ==  'ya' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_jiwa == 'ya' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="ya" name="radio_gangguan_jiwa"> Ya, Tahun :
                            <input type="number" id="tahun_gangguan_jiwa"
                                   value="@if(old('tahun_gangguan_jiwa')){{ old('tahun_gangguan_jiwa') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tahun_gangguan_jiwa : '' }}@endif"
                                   style="border: 0; border-bottom: 2px dotted;"
                            @if(old('gangguan_jiwa'))
                                {{ old('gangguan_jiwa') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_jiwa == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Riwayat Trauma</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'tidak_ada' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'tidak_ada' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="tidak_ada" name="radio_trauma"> Tidak Ada
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'aniaya_fisik' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'aniaya_fisik' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="aniaya_fisik" name="radio_trauma"> Aniaya Fisik
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'psikologis' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'psikologis' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="psikologis" name="radio_trauma"> Psikologis
                        </div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'kdrt' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kdrt' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kdrt" name="radio_trauma"> KDRT
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'pemerkosaan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'pemerkosaan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="pemerkosaan" name="radio_trauma"> Aniaya Sex/Pemerkosaan
                        </div>
                        <div class="col-md-8">
                            <input onclick="cek_radio_riwayat_trauma()"
                                   @if(old('riwayat_trauma'))
                                       {{ old('riwayat_trauma') ==  'kriminal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kriminal' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kriminal" name="radio_trauma"> Tindakan Kriminal, Sebutkan :
                            <input type="text" readonly
                                   value="@if(old('ket_kriminal')){{ old('ket_kriminal') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_kriminal : '' }}@endif"
                                   id="ket_kriminal" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('riwayat_trauma'))
                                {{ old('riwayat_trauma') ==  'kriminal' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_trauma == 'kriminal' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Alam Perasaan</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('perasaan'))
                                       {{ old('perasaan') ==  'sedih' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'sedih' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="sedih" name="radio_perasaan"> Sedih
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perasaan'))
                                       {{ old('perasaan') ==  'tenang' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'tenang' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="tenang" name="radio_perasaan"> Tenang
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perasaan'))
                                       {{ old('perasaan') ==  'putus_asa' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'putus_asa' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="putus_asa" name="radio_perasaan"> Putus Asa
                        </div>
                        <div class="col-md-2">
                            <input @if(old('perasaan'))
                                       {{ old('perasaan') ==  'ketakutan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'ketakutan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="ketakutan" name="radio_perasaan"> Ketakutan
                        </div>
                        <div class="col-md-3">
                            <input @if(old('perasaan'))
                                       {{ old('perasaan') ==  'gembira_berlebih' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->perasaan == 'gembira_berlebih' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="gembira_berlebih" name="radio_perasaan"> Gembira Berlebih
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 17%">Interaksi Selama Wawancara</td>
                <td colspan="5" style="padding-left: 10px;">
                    <div class="row">
                        <div class="col-md-2">
                            <input @if(old('wawancara'))
                                       {{ old('wawancara') ==  'Kooperatif' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'Kooperatif' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="Kooperatif" name="radio_wawancara"> Kooperatif
                        </div>
                        <div class="col-md-2">
                            <input @if(old('wawancara'))
                                       {{ old('wawancara') ==  'bermusuhan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'bermusuhan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="bermusuhan" name="radio_wawancara"> Bermusuhan
                        </div>
                        <div class="col-md-2">
                            <input @if(old('wawancara'))
                                       {{ old('wawancara') ==  'tidak_kooperatif' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'tidak_kooperatif' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidak_kooperatif" name="radio_wawancara"> Tidak Kooperatif
                        </div>
                        <div class="col-md-4">
                            <input @if(old('wawancara'))
                                       {{ old('wawancara') ==  'mudah_tersinggung' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'mudah_tersinggung' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="mudah_tersinggung" name="radio_wawancara"> Mudah Tersinggung
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input @if(old('wawancara'))
                                       {{ old('wawancara') ==  'kontak_mata' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->wawancara == 'kontak_mata' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kontak_mata" name="radio_wawancara"> Kontak Mata Berkurang
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-3">Kebutuhan Spiritual Pasien</div>
                        <div>:</div>
                        <div class="col-md-1">
                            <input @if(old('spiritual'))
                                       {{ old('spiritual') ==  'baik' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->spiritual == 'baik' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="baik" name="radio_spiritual"> Baik
                        </div>
                        <div class="col-md-4">
                            <input @if(old('spiritual'))
                                       {{ old('spiritual') ==  'tidak' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->spiritual == 'tidak' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="tidak" name="radio_spiritual"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-3">Pasien Membutuhkan Spiritual Agama</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('kebutuhan_spiritual'))
                                       {{ old('kebutuhan_spiritual') ==  'ya' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebutuhan_spiritual == 'ya' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="ya" name="radio_butuh_spiritual"> Ya
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kebutuhan_spiritual'))
                                       {{ old('kebutuhan_spiritual') ==  'tidak' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kebutuhan_spiritual == 'tidak' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidak" name="radio_butuh_spiritual"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Pasien Membutuhkan Bantuan dalam Menjalakan Ibadah dan Menyetujuinya :
                    <input @if(old('bantuan_ibadah'))
                            {{ old('bantuan_ibadah') ==  'ya' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bantuan_ibadah == 'ya' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="ya" name="radio_bantuan_ibadah"> Ya
                    <input @if(old('bantuan_ibadah'))
                            {{ old('bantuan_ibadah') ==  'tidak' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->bantuan_ibadah == 'tidak' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tidak" name="radio_bantuan_ibadah" class="ml-4"> Tidak
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td colspan="5" style="text-align: center">
                    <b>RIWAYAT ALERGI</b>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-3">
                            <input onclick="cek_riwayat_alergi()" @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'tidak' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'tidak' ? 'checked' : '') : 'checked' }}
                                @endif
                                type="radio" value="tidak" name="radio_riwayat_alergi"> Tidak
                            <input onclick="cek_riwayat_alergi()" @if(old('riwayat_alergi'))
                                    {{ old('riwayat_alergi') ==  'ya' ? 'checked' : '' }}
                                @else
                                    {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? 'checked' : '') : '' }}
                                @endif
                                type="radio" value="ya" name="radio_riwayat_alergi" class="ml-4"> Ya, Sebutkan : 
                        </div>
                        <div class="col-md-9">
                            <input type="text" readonly value="@if(old('riwayat_alergi1')){{ old('riwayat_alergi1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi1 : '' }}@endif"
                               id="riwayat_alergi1" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            Reaksi
                            <input type="text" readonly value="@if(old('reaksis1')){{ old('reaksis1') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis1 : '' }}@endif"
                               id="reaksis1" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <input type="text" readonly value="@if(old('riwayat_alergi2')){{ old('riwayat_alergi2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi2 : '' }}@endif"
                               id="riwayat_alergi2" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            Reaksi
                            <input type="text" readonly value="@if(old('reaksis2')){{ old('reaksis2') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis2 : '' }}@endif"
                               id="reaksis2" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <input type="text" readonly value="@if(old('riwayat_alergi3')){{ old('riwayat_alergi3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi3 : '' }}@endif"
                               id="riwayat_alergi3" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                            Reaksi
                            <input type="text" readonly value="@if(old('reaksis3')){{ old('reaksis3') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->reaksis3 : '' }}@endif"
                               id="reaksis3" style="border: 0; border-bottom: 2px dotted;"
                               @if(old('riwayat_alergi'))
                                {{ old('riwayat_alergi') ==  'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->riwayat_alergi == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid; text-align: center">
                <td colspan="6">
                    <b>ASESMEN NYERI</b>
                </td>
            </tr>
            <tr style="border-bottom: hidden">
                <td colspan="3" style="border-right: hidden">
                    Nyeri :
                    <input @if(old('nyeri'))
                               {{ old('nyeri') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_nyeri"> Tidak
                    <input @if(old('nyeri'))
                               {{ old('nyeri') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_nyeri"> Ya
                </td>
                <td colspan="3">
                    Sifat :
                    <input @if(old('sifat_nyeri'))
                               {{ old('sifat_nyeri') ==  'akut' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sifat_nyeri == 'akut' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="akut" name="radio_sifat_nyeri"> Akut
                    <input @if(old('sifat_nyeri'))
                               {{ old('sifat_nyeri') ==  'kronis' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sifat_nyeri == 'kronis' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="kronis" name="radio_sifat_nyeri"> Kronis
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-12 pt-2">
                            <table style="width: 100%;" border="1">
                                <tr>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128516;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128522;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128528;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128542;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128534;</p>
                                    </td>
                                    <td style="width: 16.5%;">
                                        <p style="font-size:100px; text-align: center;">&#128557;</p>
                                    </td>
                                </tr>
                                <tr class="text-center" style="font-weight: bold;">
                                    <td>0<br>Tidak Nyeri</td>
                                    <td>2<br>Sedikit Nyeri</td>
                                    <td>4<br>Sedikit Lebih Nyeri</td>
                                    <td>6<br>Lebih Nyeri</td>
                                    <td>8<br>Sangat Nyeri</td>
                                    <td>10<br>Nyeri Sangat Hebat</td>
                                </tr>
                            </table>
                            <!-- <img src="{{ asset('images/asesmen_nyeri.png') }}" alt=""> -->
                        </div>
                        <div class="col-md-12">
                            <p>Klasifikasi nyeri : </p>
                        </div>
                        <div class="col-md-4">
                            <ul style="list-style-type: none; margin-left: -30px;">
                                <li>0 = tidak ada nyeri</li>
                                <li>1 = nyeri seperti gatal, nyut-nyutan</li>
                                <li>2 = nyeri seperti melilit atau terpukul</li>
                                <li>3 = nyeri seperti perih atau mules</li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <ul style="list-style-type: none; margin-left: -70px;">
                                <li>4 = nyeri seperti kram atau kaku</li>
                                <li>5 = nyeri seperti tertekan</li>
                                <li>6 = nyeri seperti terbakar atau ditusuk-tusuk</li>
                                <li>7-9 = sangat nyeri tapi masih bisa dikontrol oleh pasien</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <ul style="list-style-type: none; margin-left: -30px;">
                                <li>10 = sangat nyeri, tidak dapat dikontrol oleh pasien</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">1. Kualitas Nyeri</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'nyeri_tumpul' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'nyeri_tumpul' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="nyeri_tumpul" name="radio_kualitas_nyeri"> Nyeri Tumpul
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'nyeri_tajam' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'nyeri_tajam' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="nyeri_tajam" name="radio_kualitas_nyeri"> Nyeri Tajam
                        </div>
                        <div class="col-md-2">
                            <input @if(old('kualitas_nyeri'))
                                       {{ old('kualitas_nyeri') ==  'panas' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas_nyeri == 'panas' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="panas" name="radio_kualitas_nyeri"> Panas / Terbakar
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">2. Menjalar</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') ==  'tidak' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_menjalar == 'tidak' ? 'checked' : '') : 'checked' }}
                            @endif
                            type="radio" value="tidak" name="radio_menjalar"> Tidak
                        </div>
                        <div class="col-md-6">
                            <input onclick="cek_radio_nyeri_menjalar()" @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') ==  'ya' ? 'checked' : '' }}
                            @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_menjalar == 'ya' ? 'checked' : '') : '' }}
                            @endif
                            type="radio" value="ya" name="radio_menjalar"> Ya, Ke
                            <input type="text"
                                   value="@if(old('ket_nyeri_menjalar')){{ old('ket_nyeri_menjalar') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ket_nyeri_menjalar : '' }}@endif"
                                   id="ket_nyeri_menjalar" style="border: 0; border-bottom: 2px dotted;"
                            @if(old('nyeri_menjalar'))
                                {{ old('nyeri_menjalar') == 'ya' ? '' : 'readonly' }}
                                @else
                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->nyeri_menjalar == 'ya' ? '' : 'readonly') : 'readonly' }}
                                @endif>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">3. Skor Nyeri</div>
                        <div>:</div>
                        <div class="col-md-9">
                            <select id="skor_nyeri" class="form-control" style="width: 15%;">
                                @for($i = 1; $i<=10; $i++)
                                    <option @if(old('skor_nyeri'))
                                                {{ old('skor_nyeri') == $i ? 'selected' : '' }}
                                            @elseif(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                                                {{ $dokumen->dokumen_asesment_awal_keperawatan_igd->skor_nyeri == $i ? 'selected' : '' }}
                                            @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">4. Frekuensi Nyeri</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'jarang' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'jarang' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="jarang" name="radio_frekuensi_nyeri"> Jarang
                        </div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'hilang_timbul' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'hilang_timbul' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="hilang_timbul" name="radio_frekuensi_nyeri"> Hilang Timbul
                        </div>
                        <div class="col-md-2">
                            <input @if(old('frekuensi_nyeri'))
                                       {{ old('frekuensi_nyeri') ==  'terus_menerus' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->frekuensi_nyeri == 'terus_menerus' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="terus_menerus" name="radio_frekuensi_nyeri"> Terus Menerus
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">5. Nyeri Mempengaruhi</div>
                        <div>:</div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'tidur' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'tidur' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidur" name="radio_pengaruh_nyeri"> Tidur
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'aktifitas_fisik' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'aktifitas_fisik' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="aktifitas_fisik" name="radio_pengaruh_nyeri"> Aktifitas Fisik
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'konsentrasi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'konsentrasi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="konsentrasi" name="radio_pengaruh_nyeri"> Konsentrasi
                        </div>
                        <div class="col-md-2">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'emosi' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'emosi' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="emosi" name="radio_pengaruh_nyeri"> Emosi
                        </div>
                        <div class="offset-2 col-md-2" style="padding-left: 19px">
                            <input @if(old('pengaruh_nyeri'))
                                       {{ old('pengaruh_nyeri') ==  'nafsu_makan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->pengaruh_nyeri == 'nafsu_makan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="nafsu_makan" name="radio_pengaruh_nyeri"> Nafsu Makan
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian_bordered">
            <tr>
                <td colspan="5">
                    SKALA FLACC Untuk < 6 tahun
                </td>
            </tr>
            <tr style="border: 1px solid; text-align: center">
                <td>
                    Pengkajian
                </td>
                <td>
                    0
                </td>
                <td>
                    1
                </td>
                <td>
                    2
                </td>
                <td>
                    Nilai
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Wajah
                </td>
                <td>
                    Tersenyum / Tidak Ada Ekspresi Khusus
                </td>
                <td>
                    Terkadang Meringis / Menarik Diri
                </td>
                <td>
                    Sering Menggetarkan Dagu
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_wajah')){{ old('nilai_wajah') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_wajah : '' }}@endif"
                               id="nilai_wajah" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Kaki
                </td>
                <td>
                    Gerakan Normal Relaksasi
                </td>
                <td>
                    Tidak Tenang / Tegang
                </td>
                <td>
                    Kaki Dibuat Menendang / Menarik Diri
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_kaki')){{ old('nilai_kaki') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_kaki : '' }}@endif"
                               id="nilai_kaki" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Aktifitas
                </td>
                <td>
                    Tidur Posisi Normal, Mudah Bergerak
                </td>
                <td>
                    Gerakan Menggeliat, Berguling, Kaku
                </td>
                <td>
                    Melengkungkan Punggung, Kaku, Menghentak
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_aktifitas')){{ old('nilai_aktifitas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_aktifitas : '' }}@endif"
                               id="nilai_aktifitas" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Menangis
                </td>
                <td>
                    Tidur Menangis (Bangun / Tidur)
                </td>
                <td>
                    Mengerang / Merengek
                </td>
                <td>
                    Menangis Terus, Terisak, Menjerit
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_menangis')){{ old('nilai_menangis') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_menangis : '' }}@endif"
                               id="nilai_menangis" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    Bersuara
                </td>
                <td>
                    Bersuara Normal, Tenang
                </td>
                <td>
                    Tenang Bila dipeluk digendong, atau diajak Berbicara
                </td>
                <td>
                    Sulit Untuk ditenangkan
                </td>
                <td>
                    <input type="number" class="form-control"
                               value="@if(old('nilai_bersuara')){{ old('nilai_bersuara') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nilai_bersuara : '' }}@endif"
                               id="nilai_bersuara" min="0" max="2" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="vertical-align: text-top">
                <td rowspan="6" style="width: 15%">
                    Hasil Skrining <span style="float: right">:</span>
                </td>
                <td style="width: 15%">
                    (P) Faktor Pencetus <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('faktor_pencetus')){{ old('faktor_pencetus') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->faktor_pencetus : '' }}@endif"
                               id="faktor_pencetus" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (Q) Kualitas <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('kualitas')){{ old('kualitas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->kualitas : '' }}@endif"
                               id="kualitas" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (R) Lokasi <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('lokasi')){{ old('lokasi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lokasi : '' }}@endif"
                               id="lokasi" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (S) Skala Nyeri <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('skala_nyeri')){{ old('skala_nyeri') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->skala_nyeri : '' }}@endif"
                               id="skala_nyeri" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
            <tr>
                <td style="width: 15%">
                    (T) Lama Nyeri <span style="float: right">:</span>
                </td>
                <td>
                    <input type="text" class="form-control"
                               value="@if(old('lama_nyeri')){{ old('lama_nyeri') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->lama_nyeri : '' }}@endif"
                               id="lama_nyeri" style="border: 0; border-bottom: 2px dotted;">
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%; border-top: hidden">
            <tr>
                <td colspan="6" style="text-align: center">
                    <b>PENGKAJIAN RESIKO JATUH</b>
                </td>
            </tr>
            <tr>
                <td rowspan="3" colspan="2" style="width: 40%">
                    a. Resiko Jatuh Humpty Dumpty (Anak)
                </td>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_anak'))
                            {{ old('resiko_jatuh_anak') ==  'satu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'satu' ? 'checked' : '') : 'checked' }}
                        @endif
                        type="radio" value="satu" name="radio_resiko_jatuh_anak"> Skor < 7  
                </td>
                <td colspan="2">
                    : Tidak Resiko
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_anak'))
                            {{ old('resiko_jatuh_anak') ==  'dua' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'dua' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dua" name="radio_resiko_jatuh_anak"> Skor < 7 - 11 
                </td>
                <td colspan="2">
                    : Resiko Rendah
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_anak'))
                            {{ old('resiko_jatuh_anak') ==  'tiga' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_anak == 'tiga' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tiga" name="radio_resiko_jatuh_anak"> Skor >= 12
                </td>
                <td colspan="2">
                    : Resiko Tinggi
                </td>
            </tr>
            <tr>
                <td rowspan="3" colspan="2" style="width: 40%">
                    a. Resiko Jatuh Morse (Dewasa)
                </td>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_dewasa'))
                            {{ old('resiko_jatuh_dewasa') ==  'satu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'satu' ? 'checked' : '') : 'checked' }}
                        @endif
                        type="radio" value="satu" name="radio_resiko_jatuh_dewasa"> Skor 0 - 24  
                </td>
                <td colspan="2">
                    : Tidak Resiko
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_dewasa'))
                            {{ old('resiko_jatuh_dewasa') ==  'dua' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'dua' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dua" name="radio_resiko_jatuh_dewasa"> Skor 25 - 50 
                </td>
                <td colspan="2">
                    : Resiko Rendah
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh_dewasa'))
                            {{ old('resiko_jatuh_dewasa') ==  'tiga' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh_dewasa == 'tiga' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tiga" name="radio_resiko_jatuh_dewasa"> Skor >= 51
                </td>
                <td colspan="2">
                    : Resiko Tinggi
                </td>
            </tr>
            <tr>
                <td rowspan="3" colspan="2" style="width: 40%">
                    a. Resiko Jatuh (Geriatri)
                </td>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh'))
                            {{ old('resiko_jatuh') ==  'satu' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'satu' ? 'checked' : '') : 'checked' }}
                        @endif
                        type="radio" value="satu" name="radio_resiko_jatuh"> Skor 0 - 5 
                </td>
                <td colspan="2">
                    : Tidak Resiko
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh'))
                            {{ old('resiko_jatuh') ==  'dua' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'dua' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="dua" name="radio_resiko_jatuh"> Skor 6 - 16 
                </td>
                <td colspan="2">
                    : Resiko Rendah
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">
                    <input @if(old('resiko_jatuh'))
                            {{ old('resiko_jatuh') ==  'tiga' ? 'checked' : '' }}
                        @else
                            {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->resiko_jatuh == 'tiga' ? 'checked' : '') : '' }}
                        @endif
                        type="radio" value="tiga" name="radio_resiko_jatuh"> Skor 17 - 30
                </td>
                <td colspan="2">
                    : Resiko Tinggi
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%; border-top: hidden">
            <tr>
                <td colspan="6" style="text-align: center">
                    <b>SKRINING GIZI</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-4">
                            BB :
                            <span id="berat_badan">{{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '....' }}</span> Kg
                            {{-- <input type="number" onkeydown="hitung_imt()"
                                   value="@if(old('bb_gizi')){{ old('bb_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->bb_gizi : '' }}@endif"
                                   id="bb_gizi" min="0" step="0.01" style="border: 0; border-bottom: 2px dotted;">  --}}
                            {{-- {{ $layanan->tanda_vital ? $layanan->tanda_vital->berat_badan : '....' }} Kg --}}
                        </div>
                        <div class="col-md-4">
                            PB/TB :
                            <span id="tinggi_badan">{{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '....' }}</span> cm                            
                            {{-- <input type="number" onkeydown="hitung_imt()"
                                   value="@if(old('pb_gizi')){{ old('pb_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->pb_gizi : '' }}@endif"
                                   id="pb_gizi" min="0" step="0.01" style="border: 0; border-bottom: 2px dotted;">  --}}
                            {{-- {{ $layanan->tanda_vital ? $layanan->tanda_vital->tinggi_badan : '....' }}    cm --}}
                        </div>
                        <div class="col-md-4">
                            IMT :
                            <input type="number" readonly value="@if(old('imt_gizi')){{ old('imt_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->imt_gizi : '' }}@endif" id="imt_gizi" style="border: 0; border-bottom: 2px dotted;">, BB/TB (M<sup>3</sup>)
                            {{-- <input type="number"
                                   readonly
                                   value="@if(old('imt_gizi')){{ old('imt_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->imt_gizi : '' }}@endif"
                                   id="imt_gizi" style="border: 0; border-bottom: 2px dotted;">, BB/TB (M<sup>3</sup>) --}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    1. Apakah Klien tampak kurus ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('tampak_kurus'))
                               {{ old('tampak_kurus') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tampak_kurus == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_tampak_kurus"> Ya
                    <input @if(old('tampak_kurus'))
                               {{ old('tampak_kurus') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->tampak_kurus == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_tampak_kurus"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    2. Apakah terjadi kenaikan atau penurunan berat badan 1 bulan terakhir ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('penurunan_bb'))
                               {{ old('penurunan_bb') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_penurunan_bb"> Ya
                    <input @if(old('penurunan_bb'))
                               {{ old('penurunan_bb') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->penurunan_bb == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_penurunan_bb"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    3. Apakah asupan makanan menurut yang dikarenakan penurunan nafsu makan ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('asupan_makanan'))
                               {{ old('asupan_makanan') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->asupan_makanan == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_asupan_makanan"> Ya
                    <input @if(old('asupan_makanan'))
                               {{ old('asupan_makanan') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->asupan_makanan == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_asupan_makanan"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-2">
                            Hasil Skrining <span style="float: right">:</span> 
                        </div>
                        <div class="col-md-10">
                            <textarea id="hasil_skrining_gizi" class="form-control"
                              rows="5" class="form-control">@if(old('hasil_skrining_gizi')){{ old('hasil_skrining_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hasil_skrining_gizi : '' }}@endif</textarea>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-2">
                            Saran <span style="float: right">:</span>
                        </div>
                        <div class="col-md-10">
                            <textarea id="saran_skrining_gizi" class="form-control"
                              rows="5" class="form-control">@if(old('saran_skrining_gizi')){{ old('saran_skrining_gizi') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->saran_skrining_gizi : '' }}@endif</textarea>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%;">
            <tr>
                <td colspan="6" class="text-center">
                    <b>ASSESMEN FUNGSIONAL</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>PENGKAJIAN FUNGSI</b>
                </td>
            </tr>
            <tr>
                <td rowspan="3" class="text-center">
                    a. Sensorik
                </td>
                <td style="border-right: hidden">Penglihatan</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('sensorik_penglihatan'))
                                       {{ old('sensorik_penglihatan') ==  'normal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'normal' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="normal" name="radio_sensorik_penglihatan"> Normal
                        </div>
                        <div class="col-md-3">
                            <input @if(old('sensorik_penglihatan'))
                                       {{ old('sensorik_penglihatan') ==  'kabur' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'kabur' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kabur" name="radio_sensorik_penglihatan"> Kabur
                        </div>
                        <div class="col-md-3">
                            <input @if(old('sensorik_penglihatan'))
                                       {{ old('sensorik_penglihatan') ==  'kacamata' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'kacamata' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kacamata" name="radio_sensorik_penglihatan"> Kacamata
                        </div>
                        <div class="col-md-3">
                            <input @if(old('sensorik_penglihatan'))
                                       {{ old('sensorik_penglihatan') ==  'lensa_kontak' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penglihatan == 'lensa_kontak' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="lensa_kontak" name="radio_sensorik_penglihatan"> Lensa Kontak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">Penciuman</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('sensorik_penciuman'))
                                       {{ old('sensorik_penciuman') ==  'normal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penciuman == 'normal' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="normal" name="radio_sensorik_penciuman"> Normal
                        </div>
                        <div class="col-md-3">
                            <input @if(old('sensorik_penciuman'))
                                       {{ old('sensorik_penciuman') ==  'tidak' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_penciuman == 'tidak' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidak" name="radio_sensorik_penciuman"> Tidak
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="border-right: hidden">Pendengaran</td>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('sensorik_pendengaran'))
                                       {{ old('sensorik_pendengaran') ==  'normal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'normal' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="normal" name="radio_sensorik_pendengaran"> Normal
                        </div>
                        <div class="col-md-3">
                            <input @if(old('sensorik_pendengaran'))
                                       {{ old('sensorik_pendengaran') ==  'tuli' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'tuli' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tuli" name="radio_sensorik_pendengaran"> Tuli Kanan/Kiri
                        </div>
                        <div class="col-md-6">
                            <input @if(old('sensorik_pendengaran'))
                                       {{ old('sensorik_pendengaran') ==  'alat_bantu' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->sensorik_pendengaran == 'alat_bantu' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="alat_bantu" name="radio_sensorik_pendengaran"> Alat Bantu dengar
                            kanan dan kiri
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="text-center">
                    b. Kognitif
                </td>
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('kognitif_satu'))
                                       {{ old('kognitif_satu') ==  'normal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'normal' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="normal" name="radio_kognitif_satu"> Normal
                        </div>
                        <div class="col-md-3">
                            <input @if(old('kognitif_satu'))
                                       {{ old('kognitif_satu') ==  'pelupa' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'pelupa' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="pelupa" name="radio_kognitif_satu"> Pelupa
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-3">
                            <input @if(old('kognitif_satu'))
                                       {{ old('kognitif_satu') ==  'bingung' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'bingung' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="bingung" name="radio_kognitif_satu"> Bingung
                        </div>
                        <div class="col-md-3">
                            <input @if(old('kognitif_satu'))
                                       {{ old('kognitif_satu') ==  'tidak_mengerti' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->kognitif_satu == 'tidak_mengerti' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="tidak_mengerti" name="radio_kognitif_satu"> Tidak dapat dimengerti
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="text-center">
                    c. Motorik
                </td>
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-2">
                            Aktifitas sehari-hari
                        </div>
                        <div class="col-md-3">
                            <input @if(old('motorik_satu'))
                                       {{ old('motorik_satu') ==  'mandiri' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'mandiri' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="mandiri" name="radio_motorik_satu"> Mandiri
                        </div>
                        <div class="col-md-2">
                            <input @if(old('motorik_satu'))
                                       {{ old('motorik_satu') ==  'bantuan_minimal' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'bantuan_minimal' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="bantuan_minimal" name="radio_motorik_satu"> Bantuan Minimal
                        </div>
                        <div class="col-md-4">
                            <input @if(old('motorik_satu'))
                                       {{ old('motorik_satu') ==  'bantuan_total' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_satu == 'bantuan_total' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="bantuan_total" name="radio_motorik_satu"> Bantuan Ketergantungan
                            Total
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div class="row">
                        <div class="col-md-2">
                            Berjalan
                        </div>
                        <div class="col-md-3">
                            <input @if(old('motorik_dua'))
                                       {{ old('motorik_dua') ==  'tidak_kesulitan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'tidak_kesulitan' ? 'checked' : '') : 'checked' }}
                                   @endif
                                   type="radio" value="tidak_kesulitan" name="radio_motorik_dua"> Tidak ada kesulitan
                        </div>
                        <div class="col-md-2">
                            <input @if(old('motorik_dua'))
                                       {{ old('motorik_dua') ==  'perlu_bantuan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'perlu_bantuan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="perlu_bantuan" name="radio_motorik_dua"> Perlu bantuan
                        </div>
                        <div class="col-md-2">
                            <input @if(old('motorik_dua'))
                                       {{ old('motorik_dua') ==  'sering_jatuh' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'sering_jatuh' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="sering_jatuh" name="radio_motorik_dua"> Sering jatuh
                        </div>
                        <div class="col-md-2">
                            <input @if(old('motorik_dua'))
                                       {{ old('motorik_dua') ==  'kelumpuhan' ? 'checked' : '' }}
                                   @else
                                       {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->motorik_dua == 'kelumpuhan' ? 'checked' : '') : '' }}
                                   @endif
                                   type="radio" value="kelumpuhan" name="radio_motorik_dua"> Kelumpuhan
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%;">
            <tr>
                <td colspan="6" class="text-center">
                    <b>DISCHARGE PLANNING</b>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>SARAN</b>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    1. Pasien Perlu Pelayanan Home Care ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('saran_satu'))
                               {{ old('saran_satu') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_satu == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_saran_satu"> Ya
                    <input @if(old('saran_satu'))
                               {{ old('saran_satu') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_satu == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_saran_satu"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    2. Pasien Perlu Pemasangan Implan ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('saran_dua'))
                               {{ old('saran_dua') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_dua == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_saran_dua"> Ya
                    <input @if(old('saran_dua'))
                               {{ old('saran_dua') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_dua == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_saran_dua"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    3. Apakah Pasien ketika pulang perlu perawatan dirumah ?
                </td>
                <td style="padding-left: 10px">
                    <input @if(old('saran_tiga'))
                               {{ old('saran_tiga') ==  'ya' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_tiga == 'ya' ? 'checked' : '') : '' }}
                           @endif
                           type="radio" value="ya" name="radio_saran_tiga"> Ya
                    <input @if(old('saran_tiga'))
                               {{ old('saran_tiga') ==  'tidak' ? 'checked' : '' }}
                           @else
                               {{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? ($dokumen->dokumen_asesment_awal_keperawatan_igd->saran_tiga == 'tidak' ? 'checked' : '') : 'checked' }}
                           @endif
                           type="radio" value="tidak" name="radio_saran_tiga"> Tidak
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-2">
                            Hasil Skrining <span style="float: right">:</span> 
                        </div>
                        <div class="col-md-10">
                            <textarea id="hasil_discharge_planning" class="form-control"
                              rows="5" class="form-control">@if(old('hasil_discharge_planning')){{ old('hasil_discharge_planning') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->hasil_discharge_planning : '' }}@endif</textarea>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="row">
                        <div class="col-md-2">
                            Saran <span style="float: right">:</span> 
                        </div>
                        <div class="col-md-10">
                            <textarea id="saran_discharge_planning" class="form-control"
                              rows="5" class="form-control">@if(old('saran_discharge_planning')){{ old('saran_discharge_planning') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->saran_discharge_planning : '' }}@endif</textarea>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%">
            <tr>
                <td colspan="6" class="text-center">
                    <b>RIWAYAT PENGGUNAAN OBAT</b>
                </td>
            </tr>
            <tr style="border: 1px solid; text-align: center;">
                <td>No.</td>
                <td>Nama Obat</td>
                <td>Jumlah</td>
                <td>Aturan Pakai</td>
                <td>Tgl. Mulai minum Obat</td>
                <td>Keterangan</td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">1.</td>
                <td>
                    <input type="text" id="nama_obat_satu" class="form-control" 
                            value="{{ old('nama_obat_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_satu : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_satu" class="form-control" 
                    value="{{ old('jumlah_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_satu : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_satu" class="form-control" 
                    value="{{ old('aturan_pakai_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_satu : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_satu" class="form-control" 
                    value="{{ old('tgl_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_satu : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_satu" class="form-control" 
                    value="{{ old('keterangan_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_satu : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">2.</td>
                <td>
                    <input type="text" id="nama_obat_dua" class="form-control" 
                            value="{{ old('nama_obat_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_dua : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_dua" class="form-control" 
                    value="{{ old('jumlah_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_dua : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_dua" class="form-control" 
                    value="{{ old('aturan_pakai_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_dua : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_dua" class="form-control" 
                    value="{{ old('tgl_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_dua : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_dua" class="form-control" 
                    value="{{ old('keterangan_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_dua : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">3.</td>
                <td>
                    <input type="text" id="nama_obat_tiga" class="form-control" 
                            value="{{ old('nama_obat_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_tiga : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_tiga" class="form-control" 
                    value="{{ old('jumlah_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_tiga : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_tiga" class="form-control" 
                    value="{{ old('aturan_pakai_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_tiga : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_tiga" class="form-control" 
                    value="{{ old('tgl_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_tiga : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_tiga" class="form-control" 
                    value="{{ old('keterangan_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_tiga : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">4.</td>
                <td>
                    <input type="text" id="nama_obat_empat" class="form-control" 
                            value="{{ old('nama_obat_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_empat : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_empat" class="form-control" 
                    value="{{ old('jumlah_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_empat : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_empat" class="form-control" 
                    value="{{ old('aturan_pakai_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_empat : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_empat" class="form-control" 
                    value="{{ old('tgl_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_empat : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_empat" class="form-control" 
                    value="{{ old('keterangan_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_empat : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">5</td>
                <td>
                    <input type="text" id="nama_obat_lima" class="form-control" 
                            value="{{ old('nama_obat_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_lima : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_lima" class="form-control" 
                    value="{{ old('jumlah_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_lima : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_lima" class="form-control" 
                    value="{{ old('aturan_pakai_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_lima : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_lima" class="form-control" 
                    value="{{ old('tgl_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_lima : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_lima" class="form-control" 
                    value="{{ old('keterangan_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_lima : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">6.</td>
                <td>
                    <input type="text" id="nama_obat_enam" class="form-control" 
                            value="{{ old('nama_obat_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->nama_obat_enam : '') }}">
                </td>
                <td>
                    <input type="text" id="jumlah_enam" class="form-control" 
                    value="{{ old('jumlah_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jumlah_enam : '') }}">
                </td>
                <td>
                    <input type="text" id="aturan_pakai_enam" class="form-control" 
                    value="{{ old('aturan_pakai_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->aturan_pakai_enam : '') }}">
                </td>
                <td>
                    <input type="date" id="tgl_enam" class="form-control" 
                    value="{{ old('tgl_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgl_enam : '') }}">
                </td>
                <td>
                    <input type="text" id="keterangan_enam" class="form-control" 
                    value="{{ old('keterangan_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->keterangan_enam : '') }}">
                </td>
            </tr>
        </table>
    </div>

    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%">
            <tr>
                <td colspan="6" class="text-center">
                    <b>DAFTAR MASALAH KEPERAWATAN</b>
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('masalah_keperawatan_nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan_nyeri ?? '[]')) ? 'checked' : '' }}
                    @endif id="masalah_keperawatan_nyeri" name="masalah_keperawatan_nyeri">   --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="nyeri">
                    Nyeri &nbsp;&nbsp;&nbsp;&nbsp;

                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('gangguan_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->gangguan_pernafasan ?? '[]')) ? 'checked' : '' }}
                    @endif id="gangguan_pernafasan" name="gangguan_pernafasan">   --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('gangguan_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="gangguan_pernafasan">
                    Gangguan Pernafasan &nbsp;&nbsp;&nbsp;&nbsp;     

                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('potensi_infeksi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->potensi_infeksi ?? '[]')) ? 'checked' : '' }}
                    @endif id="potensi_infeksi" name="potensi_infeksi">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('potensi_infeksi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="potensi_infeksi">
                    Potensi Infeksi &nbsp;&nbsp;&nbsp;&nbsp;

                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('volume_cairan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->volume_cairan ?? '[]')) ? 'checked' : '' }}
                    @endif id="volume_cairan" name="volume_cairan">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('volume_cairan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="volume_cairan">
                    Volume Cairan &nbsp;&nbsp;&nbsp;&nbsp;
{{-- 
                    <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('perubahan_nutrisi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->perubahan_nutrisi ?? '[]')) ? 'checked' : '' }}
                    @endif id="perubahan_nutrisi" name="perubahan_nutrisi">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('perubahan_nutrisi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="perubahan_nutrisi">
                    Perubahan Nutrisi &nbsp;&nbsp;&nbsp;&nbsp;                   
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td style="text-align: center">
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('cemas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->cemas ?? '[]')) ? 'checked' : '' }}
                    @endif id="cemas" name="cemas">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('cemas', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="cemas">
                    Cemas &nbsp;&nbsp;&nbsp;&nbsp; 

                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('perfusi_jaringan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->perfusi_jaringan ?? '[]')) ? 'checked' : '' }}
                    @endif id="perfusi_jaringan" name="perfusi_jaringan">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('perfusi_jaringan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="perfusi_jaringan">
                    Perfusi jaringan &nbsp;&nbsp;&nbsp;&nbsp; 

                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->hipertensi ?? '[]')) ? 'checked' : '' }}
                    @endif id="hipertensi" name="hipertensi">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)))
                        {{ in_array('mk_hipertensi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->masalah_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="mk_hipertensi">
                    Hipertensi &nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
            </tr>
        </table>
    </div>
    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%">
            <tr>
                <td colspan="1" class="text-center">
                    <b> Jam </b> 
                </td>
                <td colspan="5" class="text-center">
                    <b>IMPLEMENTASI KEPERAWATAN</b>
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_satu" class="form-control" value="@if(old('jam_satu')){{ old('jam_satu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_satu : '' }}@endif">
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('observasi_ttv', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->observasi_ttv ?? '[]')) ? 'checked' : '' }}
                    @endif id="observasi_ttv" name="obvasi_ttv"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('observasi_ttv', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="observasi_ttv">
                     Lakukan Observasi TTV
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_dua" class="form-control" value="@if(old('jam_dua')){{ old('jam_dua') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_dua : '' }}@endif">           
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('intake_output', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->intake_output ?? '[]')) ? 'checked' : '' }}
                    @endif id="intake_output" name="intake_output"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('intake_output', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="intake_output">
                    Monitor In Take Out Put
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_tiga" class="form-control" value="@if(old('jam_tiga')){{ old('jam_tiga') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tiga : '' }}@endif">            
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('monitor_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->monitor_pernafasan ?? '[]')) ? 'checked' : '' }}
                    @endif id="monitor_pernafasan" name="monitor_pernafasan"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('monitor_pernafasan', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="monitor_pernafasan">
                    Monitor Pernafasan : Irama, Pengembangan dinding dada, Penggunaan otot tambahan pernafasan, bunyi nafas
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_empat" class="form-control" value="@if(old('jam_empat')){{ old('jam_empat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empat : '' }}@endif">            
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('oksimetri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->oksimetri ?? '[]')) ? 'checked' : '' }}
                    @endif id="oksimetri" name="oksimetri"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('oksimetri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="oksimetri">
                    Lakukan Pemasangan Oksimetri
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_lima" class="form-control" value="@if(old('jam_lima')){{ old('jam_lima') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_lima : '' }}@endif">        
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('semi_flower', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->semi_flower ?? '[]')) ? 'checked' : '' }}
                    @endif id="semi_flower" name="semi_flower"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('semi_flower', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="semi_flower">
                    Berikan Posisi Semi Flower atau Posisi Miring yang Aman</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_enam" class="form-control" value="@if(old('jam_enam')){{ old('jam_enam') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enam : '' }}@endif">       
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('pemasangan_opa', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pemasangan_opa ?? '[]')) ? 'checked' : '' }}
                    @endif id="pemasangan_opa" name="pemasangan_opa"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('pemasangan_opa', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="pemasangan_opa">
                    Lakukan Pemasangan OPA
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_tujuh" class="form-control" value="@if(old('jam_tujuh')){{ old('jam_tujuh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tujuh : '' }}@endif">           
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('sutlon', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->sutlon ?? '[]')) ? 'checked' : '' }}
                    @endif id="sutlon" name="sutlon">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('sutlon', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="sutlon">
                    Lakukan Su tlon bila perlu</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_delapan" class="form-control" value="@if(old('jam_delapan')){{ old('jam_delapan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_delapan : '' }}@endif">         
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('nafas_efektif', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->nafas_efektif ?? '[]')) ? 'checked' : '' }}
                    @endif id="nafas_efektif" name="nafas_efektif"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('nafas_efektif', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="nafas_efektif">
                    Ajarkan Pasien untuk Nafas dalam Bentuk Efektif
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_sembilan" class="form-control" value="@if(old('jam_sembilan')){{ old('jam_sembilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sembilan : '' }}@endif">           
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('oksigen', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->oksigen ?? '[]')) ? 'checked' : '' }}
                    @endif id="oksigen" name="oksigen">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('oksigen', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="oksigen">
                    Berilah Oksigen 
                    
                    <input id="liter" type="text" style="border: 0; border-bottom: 2px dotted;" name="liter" value="{{ old('liter', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->liter : '') }}">
                    liter/m
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_sepuluh" class="form-control" value="@if(old('jam_sepuluh')){{ old('jam_sepuluh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sepuluh : '' }}@endif">         
                </td>
                <td>&nbsp;
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('imobilisasi', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="imobilisasi">

                    Imobilisasikan Daerah Cedera : Pasang Bidai / Spalak / Sling</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_sebelas" class="form-control" value="@if(old('jam_sebelas')){{ old('jam_sebelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_sebelas : '' }}@endif">
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('perawatan_luka', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->perawatan_luka ?? '[]')) ? 'checked' : '' }}
                    @endif id="perawatan_luka" name="perawatan_luka">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('perawatan_luka', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="perawatan_luka">
                    Lakukan Perawatan Luka</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_duabelas" class="form-control" value="@if(old('jam_duabelas')){{ old('jam_duabelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_duabelas : '' }}@endif">         
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('pengelolaan_nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->pengelolaan_nyeri ?? '[]')) ? 'checked' : '' }}
                    @endif id="pengelolaan_nyeri" name="pengelolaan_nyeri"> --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('pengelolaan_nyeri', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="pengelolaan_nyeri">
                    Ajarkan Management Pengelolaan Nyeri</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_tigabelas" class="form-control" value="@if(old('jam_tigabelas')){{ old('jam_tigabelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_tigabelas : '' }}@endif">         
                </td>
                <td>&nbsp;
                    {{-- <input type="checkbox" @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd))
                    {{ in_array('teknik_asepti', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->teknik_asepti ?? '[]')) ? 'checked' : '' }}
                    @endif id="teknik_asepti" name="teknik_asepti">  --}}
                    <input type="checkbox" 
                    @if(isset($dokumen->dokumen_asesment_awal_keperawatan_igd) && is_array(json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)))
                        {{ in_array('teknik_asepti', json_decode($dokumen->dokumen_asesment_awal_keperawatan_igd->implementasi_keperawatan)) ? 'checked' : '' }}
                    @endif 
                    id="teknik_asepti">
                    Lakukan Tindakan dengan Teknik Asepti</td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_empatbelas" class="form-control" value="@if(old('jam_empatbelas')){{ old('jam_empatbelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_empatbelas : '' }}@endif">            
                </td>
                <td>
                    <input type="text" id="ik_satu" class="form-control" value="{{ old('ik_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_satu : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_limabelas" class="form-control" value="@if(old('jam_limabelas')){{ old('jam_limabelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_limabelas : '' }}@endif">                          
                </td>
                <td>
                    <input type="text" id="ik_dua" class="form-control" 
                    value="{{ old('ik_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_dua : '') }}">
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td>
                    <input type="time" id="jam_enambelas" class="form-control" value="@if(old('jam_enambelas')){{ old('jam_enambelas') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jam_enambelas : '' }}@endif">         
                </td>
                <td>
                    <input type="text" id="ik_tiga" class="form-control" 
                    value="{{ old('ik_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->ik_tiga : '') }}">
                 </td>
            </tr>
          
        </table>
    </div>

    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%">
            <tr>
                <td colspan="6" class="text-center">
                    <b>TINDAKAN TERINTEGRASI</b>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <b> Tgl & Jam </b> 
                </td>
                <td colspan="4" class="text-center">
                    <b>Tindakan</b>
                </td>
                <td colspan="1" class="text-center">
                    <b>Nama & ttd</b>
                </td>
            </tr>
            <tr style="border: 1px solid;">
                {{-- <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamsatu" class="form-control" 
                    value="{{ old('tgljamsatu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? \Carbon\Carbon::parse($dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsatu)->format('Y-m-d\TH:i') : '') }}">
                </td> --}}
                <td>
                    <input type="datetime-local" id="tgljamsatu" class="form-control" 
                    value="{{ old('tgljamsatu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsatu : '') }}">
                </td>

                <td colspan="4">
                    <input type="text" id="tindakansatu" class="form-control" 
                    value="{{ old('tindakansatu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansatu : '') }}">
                </td>
                <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansatu))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>                
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamdua" class="form-control" 
                    value="{{ old('tgljamdua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdua : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakandua" class="form-control" 
                    value="{{ old('tindakandua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandua : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandua))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamtiga" class="form-control" 
                    value="{{ old('tgljamtiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtiga : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakantiga" class="form-control" 
                    value="{{ old('tindakantiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantiga : '') }}">
                </td>
                <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantiga))
                        
                        {{-- <br>
                        Perawat IGD
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif                    
                </td>                
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamempat" class="form-control" 
                    value="{{ old('tgljamempat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamempat : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakanempat" class="form-control" 
                    value="{{ old('tindakanempat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanempat : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanempat))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamlima" class="form-control" 
                    value="{{ old('tgljamlima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamlima : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakanlima" class="form-control" 
                    value="{{ old('tindakanlima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanlima : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanlima))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamenam" class="form-control" 
                    value="{{ old('tgljamenam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamenam : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakanenam" class="form-control" 
                    value="{{ old('tindakanenam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanenam : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakanenam))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamtujuh" class="form-control" 
                    value="{{ old('tgljamtujuh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamtujuh : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakantujuh" class="form-control" 
                    value="{{ old('tindakantujuh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantujuh : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakantujuh))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamdelapan" class="form-control" 
                    value="{{ old('tgljamdelapan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamdelapan : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakandelapan" class="form-control" 
                    value="{{ old('tindakandelapan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandelapan : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakandelapan))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamsembilan" class="form-control" 
                    value="{{ old('tgljamsembilan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsembilan : '') }}">
                </td>
                <td colspan="4">
                    <input type="text" id="tindakansembilan" class="form-control" 
                    value="{{ old('tindakansembilan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansembilan : '') }}">
                </td>
                 <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansembilan))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
            <tr style="border: 1px solid;">
                <td colspan="1" style="width: 40px;">
                    <input type="datetime-local" id="tgljamsepuluh" class="form-control" 
                    value="{{ old('tgljamsepuluh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tgljamsepuluh : '') }}">                  
                </td>
                <td colspan="4">
                    <input type="text" id="tindakansepuluh" class="form-control" 
                    value="{{ old('tindakansepuluh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansepuluh : '') }}">
                </td>
                <td colspan="1" style="width: 20px; text-align: center">
                    @if($dokumen->id_verifikator == 1 && empty($dokumen->dokumen_asesment_awal_keperawatan_igd->tindakansepuluh))
                        
                    {{-- <br>
                    Perawat IGD
                    <br>
                    <br>
                    (.................................................)
                        <br>Ttd & Nama Terang --}}
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}" style="height: 1cm; width: 2cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 1cm; width: 2cm;" alt="">
                        @endif
                        <p style="font-size: 10px;">({{$dokumen->nama_verifikator}})
                    @endif  
                </td>
            </tr>
        </table>
    </div>

    <div class="row" style="width: 100%; margin-left: 0;">
        <table class="table_isian_bordered" style="width: 100%">
            <tr>
                <td colspan="6" class="text-center">
                    <b>PEMBERIAN OBAT / INFUS (TERINTEGRASI)</b>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <b> No. </b> 
                </td>
                <td colspan="2" class="text-center">
                    <b>Nama Obat/Cairan</b>
                </td>
                <td colspan="1" class="text-center">
                    <b>Dosis</b>
                </td>
                <td colspan="1" class="text-center">
                    <b>ORAL/IV/IM/IC/SC</b>
                </td>
                <td colspan="1" class="text-center">
                    <b>Jam Pemberian</b>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">1.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_satu" class="form-control" 
                    value="{{ old('obat_cairan_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_satu : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_satu" class="form-control" 
                    value="{{ old('dosis_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_satu : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_satu" class="form-control" 
                    value="{{ old('oral_satu', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_satu : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_satu" class="form-control" value="@if(old('jampemberian_satu')){{ old('jampemberian_satu') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_satu : '' }}@endif">          
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">2.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_dua" class="form-control" 
                    value="{{ old('obat_cairan_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_dua : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_dua" class="form-control" 
                    value="{{ old('dosis_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_dua : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_dua" class="form-control" 
                    value="{{ old('oral_dua', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_dua : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_dua" class="form-control" value="@if(old('jampemberian_dua')){{ old('jampemberian_dua') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_dua : '' }}@endif">               
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">3.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_tiga" class="form-control" 
                    value="{{ old('obat_cairan_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_tiga : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_tiga" class="form-control" 
                    value="{{ old('dosis_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_tiga : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_tiga" class="form-control" 
                    value="{{ old('oral_tiga', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_tiga : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_tiga" class="form-control" value="@if(old('jampemberian_tiga')){{ old('jampemberian_tiga') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tiga : '' }}@endif">             
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">4.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_empat" class="form-control" 
                    value="{{ old('obat_cairan_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_empat : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_empat" class="form-control" 
                    value="{{ old('dosis_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_empat : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_empat" class="form-control" 
                    value="{{ old('oral_empat', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_empat : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_empat" class="form-control" value="@if(old('jampemberian_empat')){{ old('jampemberian_empat') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_empat : '' }}@endif">              
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">5.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_lima" class="form-control" 
                    value="{{ old('obat_cairan_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_lima : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_lima" class="form-control" 
                    value="{{ old('dosis_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_lima : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_lima" class="form-control" 
                    value="{{ old('oral_lima', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_lima : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_lima" class="form-control" value="@if(old('jampemberian_lima')){{ old('jampemberian_lima') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_lima : '' }}@endif">             
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">6.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_enam" class="form-control" 
                    value="{{ old('obat_cairan_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_enam : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_enam" class="form-control" 
                    value="{{ old('dosis_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_enam : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_enam" class="form-control" 
                    value="{{ old('oral_enam', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_enam : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_enam" class="form-control" value="@if(old('jampemberian_enam')){{ old('jampemberian_enam') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_enam : '' }}@endif">              
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">7.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_tujuh" class="form-control" 
                    value="{{ old('obat_cairan_tujuh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_tujuh : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_tujuh" class="form-control" 
                    value="{{ old('dosis_tujuh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_tujuh : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_tujuh" class="form-control" 
                    value="{{ old('oral_tujuh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_tujuh : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_tujuh" class="form-control" value="@if(old('jampemberian_tujuh')){{ old('jampemberian_tujuh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_tujuh : '' }}@endif">              
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">8.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_delapan" class="form-control" 
                    value="{{ old('obat_cairan_delapan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_delapan : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_delapan" class="form-control" 
                    value="{{ old('dosis_delapan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_delapan : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_delapan" class="form-control" 
                    value="{{ old('oral_delapan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_delapan : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_delapan" class="form-control" value="@if(old('jampemberian_delapan')){{ old('jampemberian_delapan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_delapan : '' }}@endif">              
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">9.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_sembilan" class="form-control" 
                    value="{{ old('obat_cairan_sembilan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_sembilan : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_sembilan" class="form-control" 
                    value="{{ old('dosis_sembilan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_sembilan : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_sembilan" class="form-control" 
                    value="{{ old('oral_sembilan', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_sembilan : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_sembilan" class="form-control" value="@if(old('jampemberian_sembilan')){{ old('jampemberian_sembilan') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sembilan : '' }}@endif">              
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">10.</td>
                <td colspan="2">
                    <input type="text" id="obat_cairan_sepuluh" class="form-control" 
                    value="{{ old('obat_cairan_sepuluh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->obat_cairan_sepuluh : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="dosis_sepuluh" class="form-control" 
                    value="{{ old('dosis_sepuluh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->dosis_sepuluh : '') }}">
                </td>
                <td colspan="1">
                    <input type="text" id="oral_sepuluh" class="form-control" 
                    value="{{ old('oral_sepuluh', $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->oral_sepuluh : '') }}">
                </td>
                <td colspan="1">
                    <input type="time" id="jampemberian_sepuluh" class="form-control" value="@if(old('jampemberian_sepuluh')){{ old('jampemberian_sepuluh') }}@else{{ $dokumen->dokumen_asesment_awal_keperawatan_igd ? $dokumen->dokumen_asesment_awal_keperawatan_igd->jampemberian_sepuluh : '' }}@endif">            
                </td>
            </tr>
        </table>
    </div>

    <div class="row" style="width: 100%; margin-left: 0;">
        <table style="width: 100%; border-top: hidden" class="table_isian">
            <tr style="border: 1px solid">
                <td style="width: 100%; text-align: center">
                    Bekasi, {{ date('d-m-Y', strtotime($dokumen->created_at)) }}, Jam: {{ date('H:i', strtotime($dokumen->created_at)) }} WIB
                </td>
            </tr>
            <tr style="border: 1px solid">
                {{-- <td style="width: 50%; text-align: center">
                    @if(is_null($dokumen->signature_pasien) && $dokumen->signature_pasien == "")
                        Mengetahui
                        <br>
                        Pasien / Keluarga
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang
                    @else
                        @if(!is_null($dokumen->signature_pasien) && $dokumen->signature_pasien != "")
                            <img src="{{ asset('signature_patient/'.$dokumen->signature_pasien) }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_pasien}})
                        
                    @endif
                </td> --}}
                <td style="width: 100%; text-align: center">
                    @if($dokumen->id_verifikator == 0)
                        <br>
                        Perawat IGD
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.................................................)
                        <br>Ttd & Nama Terang
                    @else
                        @if(isset($employee))
                            <img src="{{ env('SMIS_UPLOAD_URL').'/'.$employee->ttd }}"
                                    style="height: 4cm; width: 5cm;" alt="">
                        @else
                            <img src="{{ env('SMIS_UPLOAD_URL').'/' }}" style="height: 4cm; width: 5cm;" alt="">
                        @endif
                        <br>({{$dokumen->nama_verifikator}})
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row pt-5" style="width:100%; margin-left:0">
    {{-- <div class="col-md-4" onclick="open_modal_pasien()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>TTD Pasien / Keluarga</h5>
    </div>
    <div class="col-md-2"></div> --}}
    
    <div class="col-md-4"></div>
    <div class="col-md-4" onclick="open_modal_petugas()" style="border:1px solid; height:250px; display: flex; align-items:center; justify-content: center;">
        <h5>Ttd Perawat yang Melakukan Asesmen</h5>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <button onclick="submit_form()" class="btn btn-success">Simpan</button>
    </div>
</div>
<div class="row pb-5 pt-5" style="width:100%; margin-left:0;">
    <div style="text-align: center;" class="col-md-12">
        @if($dokumen->id_verifikator != 0)
            <a href="{{ url('e_rekam_medis/detail/pdf_dokumen_asesment_awal_keperawatan_igd?dokumen='.$dokumen->id) }}"
               class="btn btn-success" target="_blank">Download PDF</a>
        @endif
    </div>
</div>

<div class="modal fade" id="modal_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" onsubmit="return konfirmasi_ttd(this)" action="{{ url('e_rekam_medis/detail/save_ttd_dokumen_kunjungan') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="dokumen" value="{{$dokumen->id}}">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <h6>Nama Penerima Edukasi</h6>
                            <input type="text" class="form-control" name="nama_pasien" id="nama_pasien">
                        </div>
                        <div class="form-group text-center">
                            <h6>Signature :</h6>
                            <canvas style="border: 2px solid;" id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button id="clear" type="button" class="btn btn-danger btn-sm">Clear Signature</button>
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

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('app-assets/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/signaturepad.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.7/jquery.autocomplete.min.js"></script>
<script>
    function submit_form() {
        $('#form_persetujuan').submit();
    }

    function cek_form() {
        // var masalah_keperawatan_nyeri = [];
        // if ($('#masalah_keperawatan_nyeri').is(":checked")) {
        //     masalah_keperawatan_nyeri.push('masalah_keperawatan_nyeri');
        // }
        // $('#hide_masalah_keperawatan_nyeri').val(JSON.stringify(masalah_keperawatan_nyeri));

        // var gangguan_pernafasan = [];
        // if ($('#gangguan_pernafasan').is(":checked")) {
        //     gangguan_pernafasan.push('gangguan_pernafasan');
        // }
        // $('#hide_gangguan_pernafasan').val(JSON.stringify(gangguan_pernafasan));

        // var potensi_infeksi = [];
        // if ($('#potensi_infeksi').is(":checked")) {
        //     potensi_infeksi.push('potensi_infeksi');
        // }
        // $('#hide_potensi_infeksi').val(JSON.stringify(potensi_infeksi));

        // var volume_cairan = [];
        // if ($('#volume_cairan').is(":checked")) {
        //     volume_cairan.push('volume_cairan');
        // }
        // $('#hide_volume_cairan').val(JSON.stringify(volume_cairan));

        // var perubahan_nutrisi = [];
        // if ($('#perubahan_nutrisi').is(":checked")) {
        //     perubahan_nutrisi.push('perubahan_nutrisi');
        // }
        // $('#hide_perubahan_nutrisi').val(JSON.stringify(perubahan_nutrisi));

        // var cemas = [];
        // if ($('#cemas').is(":checked")) {
        //     cemas.push('cemas');
        // }
        // $('#hide_cemas').val(JSON.stringify(cemas));

        // var perfusi_jaringan = [];
        // if ($('#perfusi_jaringan').is(":checked")) {
        //     perfusi_jaringan.push('perfusi_jaringan');
        // }
        // $('#hide_perfusi_jaringan').val(JSON.stringify(perfusi_jaringan));

        // var hipertensi = [];
        // if ($('#hipertensi').is(":checked")) {
        //     hipertensi.push('hipertensi');
        // }
        // $('#hide_hipertensi').val(JSON.stringify(hipertensi));

        var observasi_ttv = [];
        if ($('#observasi_ttv').is(":checked")) {
            observasi_ttv.push('observasi_ttv');
        }
        $('#hide_observasi_ttv').val(JSON.stringify(observasi_ttv));

        var intake_output = [];
        if ($('#intake_output').is(":checked")) {
            intake_output.push('intake_output');
        }
        $('#hide_intake_output').val(JSON.stringify(intake_output));

        var monitor_pernafasan = [];
        if ($('#monitor_pernafasan').is(":checked")) {
            monitor_pernafasan.push('monitor_pernafasan');
        }
        $('#hide_monitor_pernafasan').val(JSON.stringify(monitor_pernafasan));

        var oksimetri = [];
        if ($('#oksimetri').is(":checked")) {
            oksimetri.push('oksimetri');
        }
        $('#hide_oksimetri').val(JSON.stringify(oksimetri));

        var semi_flower = [];
        if ($('#semi_flower').is(":checked")) {
            semi_flower.push('semi_flower');
        }
        $('#hide_semi_flower').val(JSON.stringify(semi_flower));

        var pemasangan_opa = [];
        if ($('#pemasangan_opa').is(":checked")) {
            pemasangan_opa.push('pemasangan_opa');
        }
        $('#hide_pemasangan_opa').val(JSON.stringify(pemasangan_opa));

        var sutlon = [];
        if ($('#sutlon').is(":checked")) {
            sutlon.push('sutlon');
        }
        $('#hide_sutlon').val(JSON.stringify(sutlon));

        var nafas_efektif = [];
        if ($('#nafas_efektif').is(":checked")) {
            nafas_efektif.push('nafas_efektif');
        }
        $('#hide_nafas_efektif').val(JSON.stringify(nafas_efektif));

        var oksigen = [];
        if ($('#oksigen').is(":checked")) {
            oksigen.push('oksigen');
        }
        $('#hide_oksigen').val(JSON.stringify(oksigen));

        var imobilisasi = [];
        if ($('#imobilisasi').is(":checked")) {
            imobilisasi.push('imobilisasi');
        }
        $('#hide_imobilisasi').val(JSON.stringify(imobilisasi));

        var perawatan_luka = [];
        if ($('#perawatan_luka').is(":checked")) {
            perawatan_luka.push('perawatan_luka');
        }
        $('#hide_perawatan_luka').val(JSON.stringify(perawatan_luka));

        var pengelolaan_nyeri = [];
        if ($('#pengelolaan_nyeri').is(":checked")) {
            pengelolaan_nyeri.push('pengelolaan_nyeri');
        }
        $('#hide_pengelolaan_nyeri').val(JSON.stringify(pengelolaan_nyeri));

        var teknik_asepti = [];
        if ($('#teknik_asepti').is(":checked")) {
            teknik_asepti.push('teknik_asepti');
        }

        
        var transportasi = [];
        if ($('#ambulance').is(":checked")){
            transportasi.push('ambulance');
        }
        if ($('#pribadi').is(":checked")){
            transportasi.push('pribadi');
        }
        if ($('#sendiri').is(":checked")){
            transportasi.push('sendiri');
        }
        if ($('#rujukan').is(":checked")){
            transportasi.push('rujukan');
        }
        if ($('#auto_anamnesa').is(":checked")){
            transportasi.push('auto_anamnesa');
        }
        if ($('#allo').is(":checked")){
            transportasi.push('allo');
        }

        var tanda_kehidupan = [];
        if ($('#death_on_arrival').is(":checked")){
            tanda_kehidupan.push('death_on_arrival');
        }
        if ($('#denyut_nadi').is(":checked")){
            tanda_kehidupan.push('denyut_nadi');
        }
        if ($('#reflek_cahaya').is(":checked")){
            tanda_kehidupan.push('reflek_cahaya');
        }
        if ($('#ekg').is(":checked")){
            tanda_kehidupan.push('ekg');
        }

        var pemeriksaan_antenatal = [];
        if ($('#dokter').is(":checked")){
            pemeriksaan_antenatal.push('dokter');
        }
        if ($('#bidan').is(":checked")){
            pemeriksaan_antenatal.push('bidan');
        }
        if ($('#terdaftar').is(":checked")){
            pemeriksaan_antenatal.push('terdaftar');
        }
        if ($('#tidak_terdaftar').is(":checked")){
            pemeriksaan_antenatal.push('tidak_terdaftar');
        }
        if ($('#tidak_teratur').is(":checked")){
            pemeriksaan_antenatal.push('tidak_teratur');
        }
        if ($('#teratur').is(":checked")){
            pemeriksaan_antenatal.push('teratur');
        }

        var riwayat_ginekologi = [];
        if ($('#infertilitas').is(":checked")){
            riwayat_ginekologi.push('infertilitas');
        }
        if ($('#anemia').is(":checked")){
            riwayat_ginekologi.push('anemia');
        }
        if ($('#infeksi_virus').is(":checked")){
            riwayat_ginekologi.push('infeksi_virus');
        }
        if ($('#pms').is(":checked")){
            riwayat_ginekologi.push('pms');
        }
        if ($('#rg').is(":checked")){
            riwayat_ginekologi.push('rg');
        }

        var kebiasaan_ibu_hamil = [];
        if ($('#obat').is(":checked")){
            kebiasaan_ibu_hamil.push('obat');
        }
        if ($('#vitamin').is(":checked")){
            kebiasaan_ibu_hamil.push('vitamin');
        }
        if ($('#jamu').is(":checked")){
            kebiasaan_ibu_hamil.push('jamu');
        }
        if ($('#lain_lain').is(":checked")){
            kebiasaan_ibu_hamil.push('lain_lain');
        }
        if ($('#merokok').is(":checked")){
            kebiasaan_ibu_hamil.push('merokok');
        }

        var persentase_kebidanan = [];
        if ($('#kepala').is(":checked")){
            persentase_kebidanan.push('kepala');
        }
        if ($('#bokong').is(":checked")){
            persentase_kebidanan.push('bokong');
        }
        if ($('#penurunan').is(":checked")){
            persentase_kebidanan.push('penurunan');
        }

        var tanda_persalinan = [];
        if ($('#mules').is(":checked")){
            tanda_persalinan.push('mules');
        }
        if ($('#tp_kontraksi').is(":checked")){
            tanda_persalinan.push('tp_kontraksi');
        }

        var mayor = [];
        if ($('#ibu_demam').is(":checked")){
            mayor.push('ibu_demam');
        }
        if ($('#kpd').is(":checked")){
            mayor.push('kpd');
        }
        if ($('#ketuban_hijau').is(":checked")){
            mayor.push('ketuban_hijau');
        }
        if ($('#fetal').is(":checked")){
            mayor.push('fetal');
        }

        var masalah_keperawatan = [];
        if ($('#nyeri').is(":checked")){
            masalah_keperawatan.push('nyeri');
        }
        if ($('#gangguan_pernafasan').is(":checked")){
            masalah_keperawatan.push('gangguan_pernafasan');
        }
        if ($('#potensi_infeksi').is(":checked")){
            masalah_keperawatan.push('potensi_infeksi');
        }
        if ($('#volume_cairan').is(":checked")){
            masalah_keperawatan.push('volume_cairan');
        }
        if ($('#perubahan_nutrisi').is(":checked")){
            masalah_keperawatan.push('perubahan_nutrisi');
        }
        if ($('#cemas').is(":checked")){
            masalah_keperawatan.push('cemas');
        }
        if ($('#perfusi_jaringan').is(":checked")){
            masalah_keperawatan.push('perfusi_jaringan');
        }
        if ($('#mk_hipertensi').is(":checked")){
            masalah_keperawatan.push('mk_hipertensi');
        }

        var implementasi_keperawatan = [];
        if ($('#observasi_ttv').is(":checked")){
            implementasi_keperawatan.push('observasi_ttv');
        }
        if ($('#intake_output').is(":checked")){
            implementasi_keperawatan.push('intake_output');
        }
        if ($('#monitor_pernafasan').is(":checked")){
            implementasi_keperawatan.push('monitor_pernafasan');
        }
        if ($('#oksimetri').is(":checked")){
            implementasi_keperawatan.push('oksimetri');
        }
        if ($('#semi_flower').is(":checked")){
            implementasi_keperawatan.push('semi_flower');
        }
        if ($('#pemasangan_opa').is(":checked")){
            implementasi_keperawatan.push('pemasangan_opa');
        }
        if ($('#sutlon').is(":checked")){
            implementasi_keperawatan.push('sutlon');
        }
        if ($('#nafas_efektif').is(":checked")){
            implementasi_keperawatan.push('nafas_efektif');
        }
        if ($('#oksigen').is(":checked")){
            implementasi_keperawatan.push('oksigen');
        }
        // if ($('#liter').is(":checked")){
        //     implementasi_keperawatan.push('liter');
        // }
        if ($('#imobilisasi').is(":checked")){
            implementasi_keperawatan.push('imobilisasi');
        }
        if ($('#perawatan_luka').is(":checked")){
            implementasi_keperawatan.push('perawatan_luka');
        }
        if ($('#pengelolaan_nyeri').is(":checked")){
            implementasi_keperawatan.push('pengelolaan_nyeri');
        }
        if ($('#teknik_asepti').is(":checked")){
            implementasi_keperawatan.push('teknik_asepti');
        }

        var penyakit_ibu = [];
        if ($('#dm').is(":checked")){
            penyakit_ibu.push('dm');
        }
        if ($('#hipertensi').is(":checked")){
            penyakit_ibu.push('hipertensi');
        }
        if ($('#jantung').is(":checked")){
            penyakit_ibu.push('jantung');
        }
        if ($('#tbc').is(":checked")){
            penyakit_ibu.push('tbc');
        }
        if ($('#hepb').is(":checked")){
            penyakit_ibu.push('hepb');
        }
        if ($('#asma').is(":checked")){
            penyakit_ibu.push('asma');
        }
        if ($('#alergi').is(":checked")){
            penyakit_ibu.push('alergi');
        }
        if ($('#pi_riwayat').is(":checked")){
            penyakit_ibu.push('pi_riwayat');
        }

        var riwayat_penyakit_kehamilan = [];
        if ($('#Terdaftar').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Terdaftar');
        }
        if ($('#Anemia').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Anemia');
        }
        if ($('#Vitium').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Vitium');
        }
        if ($('#Diabetes').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Diabetes');
        }
        if ($('#Hipertensi').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Hipertensi');
        }
        if ($('#TBC').is(":checked")) {
            riwayat_penyakit_kehamilan.push('TBC');
        }
        if ($('#Hepatitis').is(":checked")) {
            riwayat_penyakit_kehamilan.push('Hepatitis');
        }
        if ($('#ACA').is(":checked")) {
            riwayat_penyakit_kehamilan.push('ACA');
        }

        var komplikasi_kehamilan_sebelumnya = [];
        if ($('#komplikasi_tidak').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('komplikasi_tidak');
        }
        if ($('#komplikasi_ada').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('komplikasi_ada');
        }
        if ($('#HAV').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('HAV');
        }
        if ($('#HPP').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('HPP');
        }
        if ($('#PEB').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('PEB');
        }
        if ($('#komplikasi_lain').is(":checked")) {
            komplikasi_kehamilan_sebelumnya.push('komplikasi_lain');
        }

        var riwayat_imunisasi = [];
        if ($('#imunisasi_tidak').is(":checked")) {
            riwayat_imunisasi.push('imunisasi_tidak');
        }
        if ($('#imunisasi_ya').is(":checked")) {
            riwayat_imunisasi.push('imunisasi_ya');
        }
        if ($('#imunisasi_tt1').is(":checked")) {
            riwayat_imunisasi.push('imunisasi_tt1');
        }
        if ($('#imunisasi_tt2').is(":checked")) {
            riwayat_imunisasi.push('imunisasi_tt2');
        }
        if ($('#imunisasi_tt3').is(":checked")) {
            riwayat_imunisasi.push('imunisasi_tt3');
        }

        var riwayat_kb = [];
        if ($('#Suntik').is(':checked')) {
            riwayat_kb.push('Suntik');
        }
        if ($('#Pil').is(':checked')) {
            riwayat_kb.push('Pil');
        }
        if ($('#Implan').is(':checked')) {
            riwayat_kb.push('Implan');
        }
        if ($('#MOW').is(':checked')) {
            riwayat_kb.push('MOW');
        }
        if ($('#kb_lain').is(':checked')) {
            riwayat_kb.push('kb_lain');
        }

        var resiko_infeksi = [];
        if($('#resiko_infeksi_ada').is(':checked')) {
            resiko_infeksi.push('resiko_infeksi_ada');
        }
        if($('#resiko_infeksi_tidak').is(':checked')) {
            resiko_infeksi.push('resiko_infeksi_tidak');
        }

        var minor = [];
        if($('#minor_satu').is(':checked')) {
            minor.push('minor_satu');
        }
        if($('#minor_dua').is(':checked')) {
            minor.push('minor_dua');
        }
        if($('#minor_tiga').is(':checked')) {
            minor.push('minor_tiga');
        }
        if($('#minor_empat').is(':checked')) {
            minor.push('minor_empat');
        }
        if($('#minor_lima').is(':checked')) {
            minor.push('minor_lima');
        }
        if($('#minor_enam').is(':checked')) {
            minor.push('minor_enam');
        }
        if($('#minor_tujuh').is(':checked')) {
            minor.push('minor_tujuh');
        }
        if($('#minor_delapan').is(':checked')) {
            minor.push('minor_delapan');
        }

        $('#hide_teknik_asepti').val(JSON.stringify(teknik_asepti));
        $('#hide_transportasi').val(JSON.stringify(transportasi));
        $('#hide_tanda_kehidupan').val(JSON.stringify(tanda_kehidupan));
        $('#hide_pemeriksaan_antenatal').val(JSON.stringify(pemeriksaan_antenatal));
        $('#hide_riwayat_ginekologi').val(JSON.stringify(riwayat_ginekologi));
        $('#hide_kebiasaan_ibu_hamil').val(JSON.stringify(kebiasaan_ibu_hamil));
        $('#hide_persentase_kebidanan').val(JSON.stringify(persentase_kebidanan));
        $('#hide_tanda_persalinan').val(JSON.stringify(tanda_persalinan));
        $('#hide_mayor').val(JSON.stringify(mayor));
        $('#hide_masalah_keperawatan').val(JSON.stringify(masalah_keperawatan));
        $('#hide_implementasi_keperawatan').val(JSON.stringify(implementasi_keperawatan));
        $('#hide_penyakit_ibu').val(JSON.stringify(penyakit_ibu));
        $('#hide_tgl_respon_time').val($("#tgl_respon_time").val());
        $('#hide_jam_respon_time').val($("#jam_respon_time").val());
        $('#hide_jenis_pembayaran').val($("#jenis_pembayaran").val());
        $('#hide_jenis_kasus').val($('[name="radio_jenis_kasus"]:checked').val());
        $('#hide_jenis_kasus_lainnya').val($("#jenis_kasus_lainnya").val());
        // $('#hide_transportasi').val($('[name="radio_transportasi"]:checked').val());
        $('#hide_rujukan_dari').val($("#rujukan_dari").val());
        $('#hide_allo_anamnesa').val($("#allo_anamnesa").val());
        $('#hide_nama').val($("#nama").val());
        $('#hide_kelamin').val($("#kelamin").val());
        $('#hide_alamat').val($("#alamat").val());
        $('#hide_agama').val($('[name="radio_agama"]:checked').val());
        $('#hide_agama_lain').val($("#agama_lain").val());
        $('#hide_status_pasien').val($('[name="radio_status_pasien"]:checked').val());
        $('#hide_hambatan_pasien').val($('[name="radio_hambatan_pasien"]:checked').val());
        $('#hide_jenis_hambatan_pasien').val($('[name="radio_jenis_hambatan_pasien"]:checked').val());
        $('#hide_ket_jenis_hambatan_pasien').val($("#ket_jenis_hambatan_pasien").val());
        $('#hide_keluhan_utama').val($("#keluhan_utama").val());
        $('#hide_airway').val($('[name="radio_airway"]:checked').val());
        $('#hide_airway_lain').val($("#airway_lain").val());
        $('#hide_breathing').val($('[name="radio_breathing"]:checked').val());
        $('#hide_breathing_lain').val($("#breathing_lain").val());
        $('#hide_pola_pernafasan').val($('[name="radio_pola_pernafasan"]:checked').val());
        $('#hide_pernafasan_lain').val($("#pernafasan_lain").val());
        $('#hide_circulation').val($('[name="radio_circulation"]:checked').val());
        $('#hide_pendarahan').val($("#pendarahan").val());
        $('#hide_pendarahan_lain').val($("#pendarahan_lain").val());
        $('#hide_luka_bakar').val($("#luka_bakar").val());
        $('#hide_crt').val($('[name="radio_crt"]:checked').val());
        $('#hide_kulit').val($('[name="radio_kulit"]:checked').val());
        $('#hide_akral').val($('[name="radio_akral"]:checked').val());
        $('#hide_turgor').val($('[name="radio_turgor"]:checked').val());
        $('#hide_skor_buka_mata').val($("#skor_buka_mata").val());
        $('#hide_skor_respon_verbal').val($("#skor_respon_verbal").val());
        $('#hide_skor_respon_motorik').val($("#skor_respon_motorik").val());
        $('#hide_e_kesadaran').val($("#e_kesadaran").val());
        $('#hide_m_kesadaran').val($("#m_kesadaran").val());
        $('#hide_v_kesadaran').val($("#v_kesadaran").val());
        $('#hide_reflek_cahaya').val($('[name="radio_reflek_cahaya"]:checked').val());
        $('#hide_kesadaran').val($('[name="radio_kesadaran"]:checked').val());
        $('#hide_diameter_pupil').val($("#diameter_pupil").val());
        $('#hide_diameter_pupil1').val($("#diameter_pupil1").val());
        $('#hide_ekstramitas_atas').val($("#ekstramitas_atas").val());
        $('#hide_ekstramitas_atas1').val($("#ekstramitas_atas1").val());
        $('#hide_ekstramitas_bawah').val($("#ekstramitas_bawah").val());
        $('#hide_ekstramitas_bawah1').val($("#ekstramitas_bawah1").val());
        $('#hide_kesadaran2').val($('[name="radio_kesadaran2"]:checked').val());
        // $('#hide_tanda_kehidupan').val($('[name="radio_tanda_kehidupan"]:checked').val());
        $('#hide_jam_penentuan_kematian').val($("#jam_penentuan_kematian").val());
        $('#hide_eksposure').val($('[name="radio_eksposure"]:checked').val());
        $('#hide_hptp').val($("#hptp").val());
        $('#hide_tafsiran_partus').val($("#tafsiran_partus").val());
        $('#hide_perkawinan').val($("#perkawinan").val());
        $('#hide_lama_perkawinan').val($("#lama_perkawinan").val());
        // $('#hide_pemeriksaan_antenatal').val($('[name="radio_pemeriksaan_antenatal"]:checked').val());
        // $('#hide_pemeriksaan_antenatal').val($("#pemeriksaan_antenatal").val());
        $('#hide_ket_pemeriksaan_antenatal').val($("#ket_pemeriksaan_antenatal").val());
        $('#hide_riwayat_kb').val(JSON.stringify(riwayat_kb));
        $('#hide_ket_riwayat_kb').val($("#ket_riwayat_kb").val());
        // $('#hide_riwayat_ginekologi').val($('[name="radio_riwayat_ginekologi"]:checked').val());
        $('#hide_ket_riwayat_ginekologi').val($("#ket_riwayat_ginekologi").val());
        $('#hide_riwayat_penyakit_kehamilan').val(JSON.stringify(riwayat_penyakit_kehamilan));
        $('#hide_riwayat_operasi').val($('[name="radio_riwayat_operasi"]:checked').val());
        $('#hide_ket_riwayat_operasi').val($("#ket_riwayat_operasi").val());
        $('#hide_tempat_riwayat_operasi').val($("#tempat_riwayat_operasi").val());
        $('#hide_komplikasi_kehamilan').val(JSON.stringify(komplikasi_kehamilan_sebelumnya));
        $('#hide_ket_det_komplikasi_kehamilan').val($("#ket_det_komplikasi_kehamilan").val());
        $('#hide_riwayat_imunisasi').val(JSON.stringify(riwayat_imunisasi));
        $('#hide_g_riwayat_kehamilan').val($("#g_riwayat_kehamilan").val());
        $('#hide_p_riwayat_kehamilan').val($("#p_riwayat_kehamilan").val());
        $('#hide_a_riwayat_kehamilan').val($("#a_riwayat_kehamilan").val());
        $('#hide_hidup_riwayat_kehamilan').val($("#hidup_riwayat_kehamilan").val());
        // $('#hide_kebiasaan_ibu_hamil').val($('[name="radio_kebiasaan_ibu_hamil"]:checked').val());
        $('#hide_obat_minum').val($('[name="radio_obat_minum"]:checked').val());
        $('#hide_ket_obat_minum_lain_lain').val($("#ket_obat_minum_lain_lain").val());
        $('#hide_tfu').val($("#tfu").val());
        $('#hide_tbj').val($("#tbj").val());
        $('#hide_letak').val($("#letak").val());
        // $('#hide_persentase_kebidanan').val($('[name="radio_persentase_kebidanan"]:checked').val());
        $('#hide_ket_persentase_kebidanan').val($("#ket_persentase_kebidanan").val());
        $('#hide_kontraksi').val($("#kontraksi").val());
        $('#hide_kekuatan').val($("#kekuatan").val());
        $('#hide_lama').val($("#lama").val());
        $('#hide_gerak_janin').val($("#gerak_janin").val());
        $('#hide_bjs').val($("#bjs").val());
        $('#hide_rad_gerak_janin').val($('[name="radio_rad_gerak_janin"]:checked').val());
        $('#hide_pd').val($("#pd").val());
        $('#hide_oleh').val($("#oleh").val());
        $('#hide_partio').val($("#partio").val());
        $('#hide_pembukaan_servik').val($('[name="radio_pembukaan_servik"]:checked').val());
        $('#hide_hodge').val($("#hodge").val());
        // $('#hide_tanda_persalinan').val($('[name="radio_tanda_persalinan"]:checked').val());
        $('#hide_tgl_kontraksi').val($("#tgl_kontraksi").val());
        $('#hide_jam_kontraksi').val($("#jam_kontraksi").val());
        $('#hide_keluar').val($('[name="radio_keluar"]:checked').val());
        $('#hide_keluar_darah').val($('[name="keluar_radio_darah"]:checked').val());
        $('#hide_keluar_air_ketuban').val($('[name="keluar_radio_air_ketuban"]:checked').val());
        $('#hide_keluar_lendir').val($('[name="keluar_radio_lendir"]:checked').val());
        $('#hide_keluar_dislokasi').val($('[name="keluar_radio_dislokasi"]:checked').val());
        var anak_ke = [];
        if ($('#anak_ke').is(":checked")) {
            anak_ke.push('anak_ke');
        }
        $('#hide_anak_ke').val(JSON.stringify(anak_ke));
        $('#hide_ket_anak_ke').val($("#ket_anak_ke").val());
        $('#hide_umur_kehamilan').val($("#umur_kehamilan").val());
        // $('#hide_penyakit_ibu').val($('[name="radio_penyakit_ibu"]:checked').val());
        $('#hide_ket_penyakit_ibu').val($("#ket_penyakit_ibu").val());
        $('#hide_riwayat_pengobatan_ibu').val($("#riwayat_pengobatan_ibu").val());
        $('#hide_riwayat_persalinan').val($('[name="radio_riwayat_persalinan"]:checked').val());
        $('#hide_ket_riwayat_persalinan').val($("#ket_riwayat_persalinan").val());
        $('#hide_riwayat_diagnosa_ibu').val($("#riwayat_diagnosa_ibu").val());
        $('#hide_tanggal_lahir_intranatal').val($("#tanggal_lahir_intranatal").val());
        $('#hide_kondisi_saat_lahir').val($("#kondisi_saat_lahir").val());
        $('#hide_riwayat_intranatal').val($('[name="radio_riwayat_intranatal"]:checked').val());
        $('#hide_ket_riwayat_intranatal').val($("#ket_riwayat_intranatal").val());
        $('#hide_cara_bersalin').val($('[name="radio_cara_bersalin"]:checked').val());
        $('#hide_letak_tali_pusat').val($("#letak_tali_pusat").val());
        $('#hide_tali_pusat').val($('[name="radio_tali_pusat"]:checked').val());
        $('#hide_ket_tali_pusat').val($("#ket_tali_pusat").val());
        $('#hide_perkembangan_anak').val($('[name="radio_perkembangan_anak"]:checked').val());
        $('#hide_ket_berguling').val($("#ket_berguling").val());
        $('#hide_ket_duduk').val($("#ket_duduk").val());
        $('#hide_ket_berjalan').val($("#ket_berjalan").val());
        $('#hide_ket_berdiri').val($("#ket_berdiri").val());
        $('#hide_resiko_infeksi').val(JSON.stringify(resiko_infeksi));
        // $('#hide_mayor').val($('[name="radio_mayor"]:checked').val());
        $('#hide_minor').val(JSON.stringify(minor));
        $('#hide_kesadaran3').val($('[name="radio_kesadaran3"]:checked').val());
        $('#hide_ket_kesadaran3').val($("#ket_kesadaran3").val());
        $('#hide_keadaan_umum2').val($("#keadaan_umum2").val());
        $('#hide_bb2').val($("#bb2").val());
        $('#hide_uraian_kepala').val($('[name="radio_uraian_kepala"]:checked').val());
        $('#hide_ket_uraian_kepala').val($("#ket_uraian_kepala").val());
        $('#hide_uraian_mata').val($('[name="radio_uraian_mata"]:checked').val());
        $('#hide_ket_uraian_mata').val($("#ket_uraian_mata").val());
        $('#hide_uraian_tht').val($('[name="radio_uraian_tht"]:checked').val());
        $('#hide_ket_uraian_tht').val($("#ket_uraian_tht").val());
        $('#hide_uraian_mulut').val($('[name="radio_uraian_mulut"]:checked').val());
        $('#hide_ket_uraian_mulut').val($("#ket_uraian_mulut").val());
        $('#hide_uraian_leher').val($('[name="radio_uraian_leher"]:checked').val());
        $('#hide_ket_uraian_leher').val($("#ket_uraian_leher").val());
        $('#hide_uraian_thorax').val($('[name="radio_uraian_thorax"]:checked').val());
        $('#hide_ket_uraian_thorax').val($("#ket_uraian_thorax").val());
        $('#hide_uraian_payudara').val($('[name="radio_uraian_payudara"]:checked').val());
        $('#hide_ket_uraian_payudara').val($("#ket_uraian_payudara").val());
        $('#hide_uraian_abdomen').val($('[name="radio_uraian_abdomen"]:checked').val());
        $('#hide_ket_uraian_abdomen').val($("#ket_uraian_abdomen").val());
        $('#hide_uraian_urogenital').val($('[name="radio_uraian_urogenital"]:checked').val());
        $('#hide_ket_uraian_urogenital').val($("#ket_uraian_urogenital").val());
        $('#hide_uraian_ekstermitas').val($('[name="radio_uraian_ekstermitas"]:checked').val());
        $('#hide_uraian_kulit').val($('[name="radio_uraian_kulit"]:checked').val());
        $('#hide_uraian_jantung').val($('[name="radio_uraian_jantung"]:checked').val());
        $('#hide_saudara').val($('[name="radio_saudara"]:checked').val());
        $("#hide_ket_kandung").val($("#ket_kandung").val());
        $("#hide_ket_tiri").val($("#ket_tiri").val());
        $('#hide_tinggal_bersama').val($('[name="radio_tinggal_bersama"]:checked').val());
        $("#hide_ket_tinggal_lainnya").val($("#ket_tinggal_lainnya").val());
        $('#hide_bicara').val($('[name="radio_bicara"]:checked').val());
        $('#hide_komunikasi').val($('[name="radio_komunikasi"]:checked').val());
        $('#hide_emosional').val($('[name="radio_emosional"]:checked').val());
        $('#hide_gangguan_jiwa').val($('[name="radio_gangguan_jiwa"]:checked').val());
        $("#hide_tahun_gangguan_jiwa").val($("#tahun_gangguan_jiwa").val());
        $('#hide_riwayat_trauma').val($('[name="radio_trauma"]:checked').val());
        $("#hide_ket_kriminal").val($("#ket_kriminal").val());
        $('#hide_perasaan').val($('[name="radio_perasaan"]:checked').val());
        $('#hide_wawancara').val($('[name="radio_wawancara"]:checked').val());
        $('#hide_spiritual').val($('[name="radio_spiritual"]:checked').val());
        $('#hide_kebutuhan_spiritual').val($('[name="radio_butuh_spiritual"]:checked').val());
        $('#hide_bantuan_ibadah').val($('[name="radio_bantuan_ibadah"]:checked').val());
        $('#hide_riwayat_alergi').val($('[name="radio_riwayat_alergi"]:checked').val());
        $('#hide_riwayat_alergi1').val($("#riwayat_alergi1").val());
        $('#hide_reaksis1').val($("#reaksis1").val());
        $('#hide_riwayat_alergi2').val($("#riwayat_alergi2").val());
        $('#hide_reaksis2').val($("#reaksis2").val());
        $('#hide_riwayat_alergi3').val($("#riwayat_alergi3").val());
        $('#hide_reaksis3').val($("#reaksis3").val());
        $('#hide_nyeri').val($('[name="radio_nyeri"]:checked').val());
        $('#hide_sifat_nyeri').val($('[name="radio_sifat_nyeri"]:checked').val());
        $('#hide_kualitas_nyeri').val($('[name="radio_kualitas_nyeri"]:checked').val());
        $('#hide_nyeri_menjalar').val($('[name="radio_menjalar"]:checked').val());
        $('#hide_ket_nyeri_menjalar').val($('#ket_nyeri_menjalar').val());
        $('#hide_skor_nyeri').val($('#skor_nyeri').val());
        $('#hide_frekuensi_nyeri').val($('[name="radio_frekuensi_nyeri"]:checked').val());
        $('#hide_pengaruh_nyeri').val($('[name="radio_pengaruh_nyeri"]:checked').val());
        $('#hide_nilai_wajah').val($("#nilai_wajah").val());
        $('#hide_nilai_kaki').val($("#nilai_kaki").val());
        $('#hide_nilai_aktifitas').val($("#nilai_aktifitas").val());
        $('#hide_nilai_menangis').val($("#nilai_menangis").val());
        $('#hide_nilai_bersuara').val($("#nilai_bersuara").val());
        $('#hide_faktor_pencetus').val($("#faktor_pencetus").val());
        $('#hide_kualitas').val($("#kualitas").val());
        $('#hide_lokasi').val($("#lokasi").val());
        $('#hide_skala_nyeri').val($("#skala_nyeri").val());
        $('#hide_lama_nyeri').val($("#lama_nyeri").val());
        $('#hide_resiko_jatuh_anak').val($('[name="radio_resiko_jatuh_anak"]:checked').val());
        $('#hide_resiko_jatuh_dewasa').val($('[name="radio_resiko_jatuh_dewasa"]:checked').val());
        $('#hide_resiko_jatuh').val($('[name="radio_resiko_jatuh"]:checked').val());
        $('#hide_bb_gizi').val($("#bb_gizi").val());
        $('#hide_pb_gizi').val($("#pb_gizi").val());
        $('#hide_imt_gizi').val($("#imt_gizi").val());
        $('#hide_tampak_kurus').val($('[name="radio_tampak_kurus"]:checked').val());
        $('#hide_penurunan_bb').val($('[name="radio_penurunan_bb"]:checked').val());
        $('#hide_asupan_makanan').val($('[name="radio_asupan_makanan"]:checked').val());
        $('#hide_hasil_skrining_gizi').val($("#hasil_skrining_gizi").val());
        $('#hide_saran_skrining_gizi').val($("#saran_skrining_gizi").val());
        $('#hide_sensorik_penglihatan').val($('[name="radio_sensorik_penglihatan"]:checked').val());
        $('#hide_sensorik_penciuman').val($('[name="radio_sensorik_penciuman"]:checked').val());
        $('#hide_sensorik_pendengaran').val($('[name="radio_sensorik_pendengaran"]:checked').val());
        $('#hide_kognitif_satu').val($('[name="radio_kognitif_satu"]:checked').val());
        $('#hide_motorik_satu').val($('[name="radio_motorik_satu"]:checked').val());
        $('#hide_motorik_dua').val($('[name="radio_motorik_dua"]:checked').val());
        $('#hide_saran_satu').val($('[name="radio_saran_satu"]:checked').val());
        $('#hide_saran_dua').val($('[name="radio_saran_dua"]:checked').val());
        $('#hide_saran_tiga').val($('[name="radio_saran_tiga"]:checked').val());
        $('#hide_hasil_discharge_planning').val($("#hasil_discharge_planning").val());
        $('#hide_saran_discharge_planning').val($("#saran_discharge_planning").val());
        $('#hide_nama_obat_satu').val($("#nama_obat_satu").val());
        $('#hide_nama_obat_dua').val($("#nama_obat_dua").val());
        $('#hide_nama_obat_tiga').val($("#nama_obat_tiga").val());
        $('#hide_nama_obat_empat').val($("#nama_obat_empat").val());
        $('#hide_nama_obat_lima').val($("#nama_obat_lima").val());
        $('#hide_nama_obat_enam').val($("#nama_obat_enam").val());
        $('#hide_jumlah_satu').val($("#jumlah_satu").val());
        $('#hide_jumlah_dua').val($("#jumlah_dua").val());
        $('#hide_jumlah_tiga').val($("#jumlah_tiga").val());
        $('#hide_jumlah_empat').val($("#jumlah_empat").val());
        $('#hide_jumlah_lima').val($("#jumlah_lima").val());
        $('#hide_jumlah_enam').val($("#jumlah_enam").val());
        $('#hide_aturan_pakai_satu').val($("#aturan_pakai_satu").val());
        $('#hide_aturan_pakai_dua').val($("#aturan_pakai_dua").val());
        $('#hide_aturan_pakai_tiga').val($("#aturan_pakai_tiga").val());
        $('#hide_aturan_pakai_empat').val($("#aturan_pakai_empat").val());
        $('#hide_aturan_pakai_lima').val($("#aturan_pakai_lima").val());
        $('#hide_aturan_pakai_enam').val($("#aturan_pakai_enam").val());
        $('#hide_tgl_satu').val($("#tgl_satu").val());
        $('#hide_tgl_dua').val($("#tgl_dua").val());
        $('#hide_tgl_tiga').val($("#tgl_tiga").val());
        $('#hide_tgl_empat').val($("#tgl_empat").val());
        $('#hide_tgl_lima').val($("#tgl_lima").val());
        $('#hide_tgl_enam').val($("#tgl_enam").val());
        $('#hide_keterangan_satu').val($("#keterangan_satu").val());
        $('#hide_keterangan_dua').val($("#keterangan_dua").val());
        $('#hide_keterangan_tiga').val($("#keterangan_tiga").val());
        $('#hide_keterangan_empat').val($("#keterangan_empat").val());
        $('#hide_keterangan_lima').val($("#keterangan_lima").val());
        $('#hide_keterangan_enam').val($("#keterangan_enam").val());

        $('#hide_jam_satu').val($("#jam_satu").val());
        $('#hide_jam_dua').val($("#jam_dua").val());
        $('#hide_jam_tiga').val($("#jam_tiga").val());
        $('#hide_jam_empat').val($("#jam_empat").val());
        $('#hide_jam_lima').val($("#jam_lima").val());
        $('#hide_jam_enam').val($("#jam_enam").val());
        $('#hide_jam_tujuh').val($("#jam_tujuh").val());
        $('#hide_jam_delapan').val($("#jam_delapan").val());
        $('#hide_jam_sembilan').val($("#jam_sembilan").val());
        $('#hide_jam_sepuluh').val($("#jam_sepuluh").val());
        $('#hide_jam_sebelas').val($("#jam_sebelas").val());
        $('#hide_jam_duabelas').val($("#jam_duabelas").val());
        $('#hide_jam_tigabelas').val($("#jam_tigabelas").val());
        $('#hide_jam_empatbelas').val($("#jam_empatbelas").val());
        $('#hide_jam_limabelas').val($("#jam_limabelas").val());
        $('#hide_jam_enambelas').val($("#jam_enambelas").val());
        $('#hide_ik_satu').val($("#ik_satu").val());
        $('#hide_ik_dua').val($("#ik_dua").val());
        $('#hide_ik_tiga').val($("#ik_tiga").val());
        $('#hide_liter').val($("#liter").val());

        $('#hide_tgljamsatu').val($("#tgljamsatu").val());
        $('#hide_tgljamdua').val($("#tgljamdua").val());
        $('#hide_tgljamtiga').val($("#tgljamtiga").val());
        $('#hide_tgljamempat').val($("#tgljamempat").val());
        $('#hide_tgljamlima').val($("#tgljamlima").val());
        $('#hide_tgljamenam').val($("#tgljamenam").val());
        $('#hide_tgljamtujuh').val($("#tgljamtujuh").val());
        $('#hide_tgljamdelapan').val($("#tgljamdelapan").val());
        $('#hide_tgljamsembilan').val($("#tgljamsembilan").val());
        $('#hide_tgljamsepuluh').val($("#tgljamsepuluh").val());

        $('#hide_tindakansatu').val($("#tindakansatu").val());
        $('#hide_tindakandua').val($("#tindakandua").val());
        $('#hide_tindakantiga').val($("#tindakantiga").val());
        $('#hide_tindakanempat').val($("#tindakanempat").val());
        $('#hide_tindakanlima').val($("#tindakanlima").val());
        $('#hide_tindakanenam').val($("#tindakanenam").val());
        $('#hide_tindakantujuh').val($("#tindakantujuh").val());
        $('#hide_tindakandelapan').val($("#tindakandelapan").val());
        $('#hide_tindakansembilan').val($("#tindakansembilan").val());
        $('#hide_tindakansepuluh').val($("#tindakansepuluh").val());

        $('#hide_obat_cairan_satu').val($("#obat_cairan_satu").val());
        $('#hide_obat_cairan_dua').val($("#obat_cairan_dua").val());
        $('#hide_obat_cairan_tiga').val($("#obat_cairan_tiga").val());
        $('#hide_obat_cairan_empat').val($("#obat_cairan_empat").val());
        $('#hide_obat_cairan_lima').val($("#obat_cairan_lima").val());
        $('#hide_obat_cairan_enam').val($("#obat_cairan_enam").val());
        $('#hide_obat_cairan_tujuh').val($("#obat_cairan_tujuh").val());
        $('#hide_obat_cairan_delapan').val($("#obat_cairan_delapan").val());
        $('#hide_obat_cairan_sembilan').val($("#obat_cairan_sembilan").val());
        $('#hide_obat_cairan_sepuluh').val($("#obat_cairan_sepuluh").val());

        $('#hide_dosis_satu').val($("#dosis_satu").val());
        $('#hide_dosis_dua').val($("#dosis_dua").val());
        $('#hide_dosis_tiga').val($("#dosis_tiga").val());
        $('#hide_dosis_empat').val($("#dosis_empat").val());
        $('#hide_dosis_lima').val($("#dosis_lima").val());
        $('#hide_dosis_enam').val($("#dosis_enam").val());
        $('#hide_dosis_tujuh').val($("#dosis_tujuh").val());
        $('#hide_dosis_delapan').val($("#dosis_delapan").val());
        $('#hide_dosis_sembilan').val($("#dosis_sembilan").val());
        $('#hide_dosis_sepuluh').val($("#dosis_sepuluh").val());

        $('#hide_oral_satu').val($("#oral_satu").val());
        $('#hide_oral_dua').val($("#oral_dua").val());
        $('#hide_oral_tiga').val($("#oral_tiga").val());
        $('#hide_oral_empat').val($("#oral_empat").val());
        $('#hide_oral_lima').val($("#oral_lima").val());
        $('#hide_oral_enam').val($("#oral_enam").val());
        $('#hide_oral_tujuh').val($("#oral_tujuh").val());
        $('#hide_oral_delapan').val($("#oral_delapan").val());
        $('#hide_oral_sembilan').val($("#oral_sembilan").val());
        $('#hide_oral_sepuluh').val($("#oral_sepuluh").val());

        $('#hide_jampemberian_satu').val($("#jampemberian_satu").val());
        $('#hide_jampemberian_dua').val($("#jampemberian_dua").val());
        $('#hide_jampemberian_tiga').val($("#jampemberian_tiga").val());
        $('#hide_jampemberian_empat').val($("#jampemberian_empat").val());
        $('#hide_jampemberian_lima').val($("#jampemberian_lima").val());
        $('#hide_jampemberian_enam').val($("#jampemberian_enam").val());
        $('#hide_jampemberian_tujuh').val($("#jampemberian_tujuh").val());
        $('#hide_jampemberian_delapan').val($("#jampemberian_delapan").val());
        $('#hide_jampemberian_sembilan').val($("#jampemberian_sembilan").val());
        $('#hide_jampemberian_sepuluh').val($("#jampemberian_sepuluh").val());

        return true;
    }

    function cek_radio_jenis_kasus() {
        if ($('[name="radio_jenis_kasus"]:checked').val() == 'lainnya') {
            $('#jenis_kasus_lainnya').removeAttr('readonly');
        } else {
            $('#jenis_kasus_lainnya').attr('readonly', true);
            $('#jenis_kasus_lainnya').val('');
        }
    }

    // function cek_radio_transportasi() {
    //     if ($('[name="radio_transportasi"]:checked').val() == 'rujukan') {
    //         $('#rujukan_dari').removeAttr('readonly');
    //         $('#allo_anamnesa').attr('readonly', true);
    //         $('#allo_anamnesa').val('');
    //     } else if ($('[name="radio_transportasi"]:checked').val() == 'allo_anamnesa') {
    //         $('#allo_anamnesa').removeAttr('readonly');
    //         $('#rujukan_dari').attr('readonly', true);
    //         $('#rujukan_dari').val('');
    //     } else {
    //         $('#allo_anamnesa').attr('readonly', true);
    //         $('#allo_anamnesa').val('');
    //         $('#rujukan_dari').attr('readonly', true);
    //         $('#rujukan_dari').val('');
    //     }
    // }

    function cek_transportasi() {
        if ($("#rujukan").prop('checked') == true){
            $('#rujukan_dari').removeAttr('readonly');
        } else {
            $('#rujukan_dari').attr('readonly', true);
            $('#rujukan_dari').val('');
        }

        if ($("#allo").prop('checked') == true){
            $('#allo_anamnesa').removeAttr('readonly');
        } else {
            $('#allo_anamnesa').attr('readonly', true);
            $('#allo_anamnesa').val('');
        }
       
    }

    function cek_pemeriksaan_antenatal() {
        if ($("#teratur").prop('checked') == true){
            $('#ket_pemeriksaan_antenatal').removeAttr('readonly');
        } else {
            $('#ket_pemeriksaan_antenatal').attr('readonly', true);
            $('#ket_pemeriksaan_antenatal').val('');
        }

        if ($("#allo").prop('checked') == true){
            $('#allo_anamnesa').removeAttr('readonly');
        } else {
            $('#allo_anamnesa').attr('readonly', true);
            $('#allo_anamnesa').val('');
        }
       
    }

    function cek_riwayat_ginekologi() {
        if ($("#rg").prop('checked') == true){
            $('#ket_riwayat_ginekologi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_ginekologi').attr('readonly', true);
            $('#ket_riwayat_ginekologi').val('');
        }
    }

    function cek_kebiasaan_ibu_hamil() {
        if ($("#lain_lain").prop('checked') == true){
            $('#ket_obat_minum_lain_lain').removeAttr('readonly');
        } else {
            $('#ket_obat_minum_lain_lain').attr('readonly', true);
            $('#ket_obat_minum_lain_lain').val('');
        }
    }

    function cek_persentase_kebidanan() {
        if ($("#penurunan").prop('checked') == true){
            $('#ket_persentase_kebidanan').removeAttr('readonly');
        } else {
            $('#ket_persentase_kebidanan').attr('readonly', true);
            $('#ket_persentase_kebidanan').val('');
        }
    }

    
    function cek_penyakit_ibu() {
        if ($("#pi_riwayat").prop('checked') == true){
            $('#ket_penyakit_ibu').removeAttr('readonly');
        } else {
            $('#ket_penyakit_ibu').attr('readonly', true);
            $('#ket_penyakit_ibu').val('');
        }
    }

    function cek_radio_agama() {
        if ($('[name="radio_jenis_kasus"]:checked').val() == 'lain_lain') {
            $('#agama_lain').removeAttr('readonly');
        } else {
            $('#agama_lain').attr('readonly', true);
            $('#agama_lain').val('');
        }
    }

    function cek_hambatan_pasien() {
        if ($('[name="radio_jenis_hambatan_pasien"]:checked').val() == 'lain_lain') {
            $('#ket_jenis_hambatan_pasien').removeAttr('readonly');
        } else {
            $('#ket_jenis_hambatan_pasien').attr('readonly', true);
            $('#ket_jenis_hambatan_pasien').val('');
        }
    }

    function cek_radio_airway() {
        if ($('[name="radio_airway"]:checked').val() == 'lain_lain') {
            $('#airway_lain').removeAttr('readonly');
        } else {
            $('#airway_lain').attr('readonly', true);
            $('#airway_lain').val('');
        }
    }

    function cek_radio_breathing() {
        if ($('[name="radio_breathing"]:checked').val() == 'lain_lain') {
            $('#breathing_lain').removeAttr('readonly');
        } else {
            $('#breathing_lain').attr('readonly', true);
            $('#breathing_lain').val('');
        }
    }

    function cek_pola_pernafasan() {
        if ($('[name="radio_pola_pernafasan"]:checked').val() == 'tidak') {
            $('#pernafasan_lain').removeAttr('readonly');
        } else {
            $('#pernafasan_lain').attr('readonly', true);
            $('#pernafasan_lain').val('');
        }
    }

    function cek_pendarahan() {
        if ($('[name="radio_pendarahan"]:checked').val() == 'ada') {
            $('#pendarahan_lain').removeAttr('readonly');
        } else {
            $('#pendarahan_lain').attr('readonly', true);
            $('#pendarahan_lain').val('');
        }
    }

    // function cek_radio_pemeriksaan_antenatal() {
    //     if ($('[name="radio_pemeriksaan_antenatal"]:checked').val() == 'teratur') {
    //         $('#ket_pemeriksaan_antenatal').removeAttr('readonly');
    //     } else {
    //         $('#ket_pemeriksaan_antenatal').attr('readonly', true);
    //         $('#ket_pemeriksaan_antenatal').val('');
    //     }
    // }

    function cek_radio_riwayat_kb() {
        if ($("#kb_lain").prop('checked') == true){
            $('#ket_riwayat_kb').removeAttr('readonly');
        } else {
            $('#ket_riwayat_kb').attr('readonly', true);
            $('#ket_riwayat_kb').val('');
        }
    }

    function cek_radio_riwayat_ginekologi() {
        if ($('[name="radio_riwayat_ginekologi"]:checked').val() == 'lain_lain') {
            $('#ket_riwayat_ginekologi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_ginekologi').attr('readonly', true);
            $('#ket_riwayat_ginekologi').val('');
        }
    }

    function cek_radio_riwayat_operasi() {
        if ($('[name="radio_riwayat_operasi"]:checked').val() == 'ya') {
            $('#ket_riwayat_operasi').removeAttr('readonly');
            $('#tempat_riwayat_operasi').removeAttr('readonly');
        } else {
            $('#ket_riwayat_operasi').attr('readonly', true);
            $('#ket_riwayat_operasi').val('');
            $('#tempat_riwayat_operasi').attr('readonly', true);
            $('#tempat_riwayat_operasi').val('');
        }
    }

    function cek_radio_komplikasi_kehamilan() {
        if ($('[name="radio_komplikasi_kehamilan"]:checked').val() == 'ada') {
            $('.radio_det_komplikasi_kehamilan').removeAttr('disabled');
        } else {
            $('.radio_det_komplikasi_kehamilan').attr('disabled', true);
            $('#ket_det_komplikasi_kehamilan').attr('readonly', true);
            $('#ket_det_komplikasi_kehamilan').val('');
        }
    }

    function cek_radio_det_komplikasi_kehamilan() {
        if ($("#komplikasi_lain").prop('checked') == true){
            $('#ket_det_komplikasi_kehamilan').removeAttr('readonly');
        } else {
            $('#ket_det_komplikasi_kehamilan').attr('readonly', true);
            $('#ket_det_komplikasi_kehamilan').val('');
        }
    }

    function cek_radio_kebiasaan_ibu_hamil() {
        if ($('[name="radio_kebiasaan_ibu_hamil"]:checked').val() == 'obat_minum') {
            $('.radio_obat_minum').removeAttr('disabled');
        } else {
            $('.radio_obat_minum').attr('disabled', true);
            $('#ket_obat_minum_lain_lain').attr('readonly', true);
            $('#ket_obat_minum_lain_lain').val('');
        }
    }

    function cek_radio_obat_minum() {
        if ($('[name="radio_obat_minum"]:checked').val() == 'lain_lain') {
            $('#ket_obat_minum_lain_lain').removeAttr('readonly');
        } else {
            $('#ket_obat_minum_lain_lain').attr('readonly', true);
            $('#ket_obat_minum_lain_lain').val('');
        }
    }

    function cek_radio_persentase_kebidanan() {
        if ($('[name="radio_persentase_kebidanan"]:checked').val() == 'penurunan') {
            $('#ket_persentase_kebidanan').removeAttr('readonly');
        } else {
            $('#ket_persentase_kebidanan').attr('readonly', true);
            $('#ket_persentase_kebidanan').val('');
        }
    }

    function cek_radio_tanda_persalinan() {
        if ($('[name="radio_tanda_persalinan"]:checked').val() == 'kontraksi') {
            $('#tgl_kontraksi').removeAttr('readonly');
            $('#jam_kontraksi').removeAttr('readonly');
        } else {
            $('#tgl_kontraksi').attr('readonly', true);
            $('#tgl_kontraksi').val('');
            $('#jam_kontraksi').attr('readonly', true);
            $('#jam_kontraksi').val('');
        }
    }

    function cek_anak_ke() {
        if ($("#anak_ke").prop('checked') == true) {
            $('#ket_anak_ke').removeAttr('readonly');
            $('#umur_kehamilan').removeAttr('readonly');
        } else {
            $('#ket_anak_ke').attr('readonly', true);
            $('#ket_anak_ke').val('');
            $('#umur_kehamilan').attr('readonly', true);
            $('#umur_kehamilan').val('');
        }
    }

    function cek_radio_penyakit_ibu() {
        if ($('[name="radio_penyakit_ibu"]:checked').val() == 'lain_lain') {
            $('#ket_penyakit_ibu').removeAttr('readonly');
        } else {
            $('#ket_penyakit_ibu').attr('readonly', true);
            $('#ket_penyakit_ibu').val('');
        }
    }

    function cek_radio_riwayat_persalinan() {
        if ($('[name="radio_riwayat_persalinan"]:checked').val() == 'lain_lain') {
            $('#ket_riwayat_persalinan').removeAttr('readonly');
        } else {
            $('#ket_riwayat_persalinan').attr('readonly', true);
            $('#ket_riwayat_persalinan').val('');
        }
    }

    function cek_radio_riwayat_intranatal() {
        if ($('[name="radio_riwayat_intranatal"]:checked').val() == 'apgar_score') {
            $('#ket_riwayat_intranatal').removeAttr('readonly');
        } else {
            $('#ket_riwayat_intranatal').attr('readonly', true);
            $('#ket_riwayat_intranatal').val('');
        }
    }

    function cek_radio_tali_pusat() {
        if ($('[name="radio_tali_pusat"]:checked').val() == 'lain_lain') {
            $('#ket_tali_pusat').removeAttr('readonly');
        } else {
            $('#ket_tali_pusat').attr('readonly', true);
            $('#ket_tali_pusat').val('');
        }
    }

    function cek_radio_perkembangan_anak() {
        if ($('[name="radio_perkembangan_anak"]:checked').val() == 'berguling') {
            $('#ket_berguling').removeAttr('readonly');
            $('#ket_duduk').attr('readonly', true);
            $('#ket_duduk').val('');
            $('#ket_berjalan').attr('readonly', true);
            $('#ket_berjalan').val('');
            $('#ket_berdiri').attr('readonly', true);
            $('#ket_berdiri').val('');
        } else if ($('[name="radio_perkembangan_anak"]:checked').val() == 'duduk') {
            $('#ket_duduk').removeAttr('readonly');
            $('#ket_berguling').attr('readonly', true);
            $('#ket_berguling').val('');
            $('#ket_berjalan').attr('readonly', true);
            $('#ket_berjalan').val('');
            $('#ket_berdiri').attr('readonly', true);
            $('#ket_berdiri').val('');
        } else if ($('[name="radio_perkembangan_anak"]:checked').val() == 'berjalan') {
            $('#ket_berjalan').removeAttr('readonly');
            $('#ket_berguling').attr('readonly', true);
            $('#ket_berguling').val('');
            $('#ket_duduk').attr('readonly', true);
            $('#ket_duduk').val('');
            $('#ket_berdiri').attr('readonly', true);
            $('#ket_berdiri').val('');
        } else {
            $('#ket_berdiri').removeAttr('readonly');
            $('#ket_berguling').attr('readonly', true);
            $('#ket_berguling').val('');
            $('#ket_duduk').attr('readonly', true);
            $('#ket_duduk').val('');
            $('#ket_berjalan').attr('readonly', true);
            $('#ket_berjalan').val('');
        }
    }

    function cek_radio_tali_pusat() {
        if ($('[name="radio_kesadaran3"]:checked').val() == 'lain_lain') {
            $('#ket_kesadaran3').removeAttr('readonly');
        } else {
            $('#ket_kesadaran3').attr('readonly', true);
            $('#ket_kesadaran3').val('');
        }
    }

    function radio_uraian_kepala() {
        if ($('[name="radio_uraian_kepala"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_kepala').removeAttr('readonly');
        } else {
            $('#ket_uraian_kepala').attr('readonly', true);
            $('#ket_uraian_kepala').val('');
        }
    }

    function cek_radio_uraian_mata() {
        if ($('[name="radio_uraian_mata"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_mata').removeAttr('readonly');
        } else {
            $('#ket_uraian_mata').attr('readonly', true);
            $('#ket_uraian_mata').val('');
        }
    }

    function cek_radio_uraian_tht() {
        if ($('[name="radio_uraian_tht"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_tht').removeAttr('readonly');
        } else {
            $('#ket_uraian_tht').attr('readonly', true);
            $('#ket_uraian_tht').val('');
        }
    }

    function cek_radio_uraian_mulut() {
        if ($('[name="radio_uraian_mulut"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_mulut').removeAttr('readonly');
        } else {
            $('#ket_uraian_mulut').attr('readonly', true);
            $('#ket_uraian_mulut').val('');
        }
    }

    function cek_radio_uraian_leher() {
        if ($('[name="radio_uraian_leher"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_leher').removeAttr('readonly');
        } else {
            $('#ket_uraian_leher').attr('readonly', true);
            $('#ket_uraian_leher').val('');
        }
    }

    function cek_radio_uraian_thorax() {
        if ($('[name="radio_uraian_thorax"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_thorax').removeAttr('readonly');
        } else {
            $('#ket_uraian_thorax').attr('readonly', true);
            $('#ket_uraian_thorax').val('');
        }
    }

    function cek_radio_uraian_payudara() {
        if ($('[name="radio_uraian_payudara"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_payudara').removeAttr('readonly');
        } else {
            $('#ket_uraian_payudara').attr('readonly', true);
            $('#ket_uraian_payudara').val('');
        }
    }

    function cek_radio_uraian_abdomen() {
        if ($('[name="radio_uraian_abdomen"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_abdomen').removeAttr('readonly');
        } else {
            $('#ket_uraian_abdomen').attr('readonly', true);
            $('#ket_uraian_abdomen').val('');
        }
    }

    function cek_radio_uraian_urogenital() {
        if ($('[name="radio_uraian_urogenital"]:checked').val() == 'lain_lain') {
            $('#ket_uraian_urogenital').removeAttr('readonly');
        } else {
            $('#ket_uraian_urogenital').attr('readonly', true);
            $('#ket_uraian_urogenital').val('');
        }
    }

    function cek_radio_saudara() {
        if ($('[name="radio_saudara"]:checked').val() == 'kandung') {
            $('#ket_kandung').removeAttr('readonly');
            $('#ket_tiri').attr('readonly', true);
            $('#ket_tiri').val('');
        } else {
            $('#ket_tiri').removeAttr('readonly');
            $('#ket_kandung').attr('readonly', true);
            $('#ket_kandung').val('');
        }
    }

    function cek_radio_tinggal_bersama() {
        if ($('[name="radio_saudara"]:checked').val() == 'tinggal_lainnya') {
            $('#ket_tinggal_lainnya').removeAttr('readonly');
        } else {
            $('#ket_tinggal_lainnya').attr('readonly', true);
            $('#ket_tinggal_lainnya').val('');
        }
    }

    function cek_radio_gangguan_jiwa() {
        if ($('[name="radio_gangguan_jiwa"]:checked').val() == 'ya') {
            $('#tahun_gangguan_jiwa').removeAttr('readonly');
        } else {
            $('#tahun_gangguan_jiwa').attr('readonly', true);
            $('#tahun_gangguan_jiwa').val('');
        }
    }

    function cek_radio_riwayat_trauma() {
        if ($('[name="radio_trauma"]:checked').val() == 'kriminal') {
            $('#ket_kriminal').removeAttr('readonly');
        } else {
            $('#ket_kriminal').attr('readonly', true);
            $('#ket_kriminal').val('');
        }
    }

    function cek_riwayat_alergi() {
        if ($('[name="radio_riwayat_alergi"]:checked').val() == 'ya') {
            $('#riwayat_alergi1').removeAttr('readonly');
            $('#reaksis1').removeAttr('readonly');
            $('#riwayat_alergi2').removeAttr('readonly');
            $('#reaksis2').removeAttr('readonly');
            $('#riwayat_alergi3').removeAttr('readonly');
            $('#reaksis3').removeAttr('readonly');
        } else {
            $('#riwayat_alergi1').attr('readonly', true);
            $('#reaksis1').val('');
            $('#riwayat_alergi2').attr('readonly', true);
            $('#reaksis2').val('');
            $('#riwayat_alergi3').attr('readonly', true);
            $('#reaksis3').val('');
        }
    }

    function cek_radio_nyeri_menjalar() {
        if ($('[name="radio_menjalar"]:checked').val() == 'ya') {
            $('#ket_nyeri_menjalar').removeAttr('readonly');
        } else {
            $('#ket_nyeri_menjalar').attr('readonly', true);
            $('#ket_nyeri_menjalar').val('');
        }
    }

    function open_modal_petugas() {
        $('#modal_petugas').modal('show');
    }

    function open_modal_pasien() {
        $('#modal_pasien').modal('show');
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
        $("#nama_pasien").val('');
    });

    function konfirmasi_ttd() {
        var data = signaturePad.toDataURL('image/png');
        $('#signature64').val(data);

        if ($('#signature64').val() == '') {
            alert('Tambahkan tanda tangan anda dahulu');
            return false;
        }

        if (!confirm('Dengan tanda tangan saya dibawah ini,saya menyatakan bahwa saya telah mengerti dan memahami persetujuan umum tersebut.')) {
            return false;
        }
    }

    var sig = $('#sig').signature({
        syncField: '#signature_status_lokasi',
        syncFormat: 'PNG',
    });

    $('#btn_clear').click(function() {
        sig.signature('clear');
    })

    window.onload = function() {
    var beratBadan = parseFloat(document.getElementById('berat_badan').innerText);
    var tinggiBadan = parseFloat(document.getElementById('tinggi_badan').innerText);

    if (beratBadan > 0 && tinggiBadan > 0) {
        // Konversi tinggi badan dari cm ke meter
        var tinggiBadanMeter = tinggiBadan / 100;

        // Hitung IMT
        var imt = beratBadan / (tinggiBadanMeter * tinggiBadanMeter);

        // Tampilkan hasil IMT ke input imt_gizi
        document.getElementById('imt_gizi').value = imt.toFixed(1);
    } else {
        document.getElementById('imt_gizi').value = '';
    }
}
</script>

</html>
