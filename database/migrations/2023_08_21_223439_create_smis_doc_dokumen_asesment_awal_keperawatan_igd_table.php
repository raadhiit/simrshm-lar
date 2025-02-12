<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDokumenAsesmentAwalKeperawatanIgdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_dokumen_asesment_awal_keperawatan_igd', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_respon_time', 64)->nullable();
            $table->string('jam_respon_time', 64)->nullable();
            $table->string('jenis_pembayaran', 64)->nullable();
            $table->string('jenis_kasus', 64)->nullable();
            $table->string('jenis_kasus_lainnya', 64)->nullable();
            $table->string('transportasi', 64)->nullable();
            $table->string('rujukan_dari', 64)->nullable();
            $table->string('allo_anamnesa', 64)->nullable();
            $table->string('nama', 64)->nullable();
            $table->string('kelamin', 64)->nullable();
            $table->string('alamat', 64)->nullable();
            $table->string('agama', 64)->nullable();
            $table->string('agama_lain', 64)->nullable();
            $table->string('status_pasien', 64)->nullable();
            $table->string('hambatan_pasien', 64)->nullable();
            $table->string('jenis_hambatan_pasien', 64)->nullable();
            $table->string('ket_jenis_hambatan_pasien', 64)->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->string('airway', 64)->nullable();
            $table->string('airway_lain', 64)->nullable();
            $table->string('breathing', 64)->nullable();
            $table->string('breathing_lain', 64)->nullable();
            $table->string('pola_pernafasan', 64)->nullable();
            $table->string('pernafasan_lain', 64)->nullable();
            $table->string('circulation', 64)->nullable();
            $table->string('pendarahan', 64)->nullable();
            $table->string('pendarahan_lain', 64)->nullable();
            $table->string('luka_bakar', 64)->nullable();
            $table->string('crt', 64)->nullable();
            $table->string('kulit', 64)->nullable();
            $table->string('akral', 64)->nullable();
            $table->string('turgor', 64)->nullable();
            $table->string('skor_buka_mata', 64)->nullable();
            $table->string('skor_respon_verbal', 64)->nullable();
            $table->string('skor_respon_motorik', 64)->nullable();
            $table->string('e_kesadaran', 64)->nullable();
            $table->string('m_kesadaran', 64)->nullable();
            $table->string('v_kesadaran', 64)->nullable();
            $table->string('reflek_cahaya', 64)->nullable();
            $table->string('kesadaran', 64)->nullable();
            $table->string('diameter_pupil', 64)->nullable();
            $table->string('diameter_pupil1', 64)->nullable();
            $table->string('ekstramitas_atas', 64)->nullable();
            $table->string('ekstramitas_atas1', 64)->nullable();
            $table->string('ekstramitas_bawah', 64)->nullable();
            $table->string('kesadaran2', 64)->nullable();
            $table->string('gambar_status_lokalis', 64)->nullable();
            $table->string('tanda_kehidupan', 64)->nullable();
            $table->string('jam_penentuan_kematian', 64)->nullable();
            $table->string('eksposure', 64)->nullable();
            $table->string('hptp', 64)->nullable();
            $table->string('tafsiran_partus', 64)->nullable();
            $table->string('perkawinan', 64)->nullable();
            $table->string('lama_perkawinan', 64)->nullable();
            $table->string('pemeriksaan_antenatal', 64)->nullable();
            $table->string('ket_pemeriksaan_antenatal', 64)->nullable();
            $table->string('riwayat_kb', 64)->nullable();
            $table->string('ket_riwayat_kb', 64)->nullable();
            $table->string('riwayat_ginekologi', 64)->nullable();
            $table->string('ket_riwayat_ginekologi', 64)->nullable();
            $table->string('riwayat_penyakit_kehamilan', 64)->nullable();
            $table->string('riwayat_operasi', 64)->nullable();
            $table->string('ket_riwayat_operasi', 64)->nullable();
            $table->string('tempat_riwayat_operasi', 64)->nullable();
            $table->string('komplikasi_kehamilan', 64)->nullable();
            $table->string('det_komplikasi_kehamilan', 64)->nullable();
            $table->string('ket_det_komplikasi_kehamilan', 64)->nullable();
            $table->string('riwayat_imunisasi', 64)->nullable();
            $table->string('g_riwayat_kehamilan', 64)->nullable();
            $table->string('p_riwayat_kehamilan', 64)->nullable();
            $table->string('a_riwayat_kehamilan', 64)->nullable();
            $table->string('hidup_riwayat_kehamilan', 64)->nullable();
            $table->string('kebiasaan_ibu_hamil', 64)->nullable();
            $table->string('obat_minum', 64)->nullable();
            $table->string('ket_obat_minum_lain_lain', 64)->nullable();
            $table->string('tfu', 64)->nullable();
            $table->string('tbj', 64)->nullable();
            $table->string('letak', 64)->nullable();
            $table->string('persentase_kebidanan', 64)->nullable();
            $table->string('ket_persentase_kebidanan', 64)->nullable();
            $table->string('kontraksi', 64)->nullable();
            $table->string('kekuatan', 64)->nullable();
            $table->string('lama', 64)->nullable();
            $table->string('gerak_janin', 64)->nullable();
            $table->string('bjs', 64)->nullable();
            $table->string('rad_gerak_janin', 64)->nullable();
            $table->string('pd', 64)->nullable();
            $table->string('oleh', 64)->nullable();
            $table->string('partio', 64)->nullable();
            $table->string('pembukaan_servik', 64)->nullable();
            $table->string('hodge', 64)->nullable();
            $table->string('tanda_persalinan', 64)->nullable();
            $table->string('tgl_kontraksi', 64)->nullable();
            $table->string('jam_kontraksi', 64)->nullable();
            $table->string('keluar', 64)->nullable();
            $table->string('keluar_darah', 64)->nullable();
            $table->string('keluar_air_ketuban', 64)->nullable();
            $table->string('keluar_lendir', 64)->nullable();
            $table->string('keluar_dislokasi', 64)->nullable();
            $table->string('anak_ke', 64)->nullable();
            $table->string('ket_anak_ke', 64)->nullable();
            $table->string('umur_kehamilan', 64)->nullable();
            $table->string('penyakit_ibu', 64)->nullable();
            $table->string('ket_penyakit_ibu', 64)->nullable();
            $table->string('riwayat_pengobatan_ibu', 64)->nullable();
            $table->string('riwayat_persalinan', 64)->nullable();
            $table->string('ket_riwayat_persalinan', 64)->nullable();
            $table->string('riwayat_diagnosa_ibu', 64)->nullable();
            $table->string('tanggal_lahir_intranatal', 64)->nullable();
            $table->string('kondisi_saat_lahir', 64)->nullable();
            $table->string('riwayat_intranatal', 64)->nullable();
            $table->string('ket_riwayat_intranatal', 64)->nullable();
            $table->string('cara_bersalin', 64)->nullable();
            $table->string('letak_tali_pusat', 64)->nullable();
            $table->string('tali_pusat', 64)->nullable();
            $table->string('ket_tali_pusat', 64)->nullable();
            $table->string('perkembangan_anak', 64)->nullable();
            $table->string('ket_berguling', 64)->nullable();
            $table->string('ket_duduk', 64)->nullable();
            $table->string('ket_berjalan', 64)->nullable();
            $table->string('ket_berdiri', 64)->nullable();
            $table->string('resiko_infeksi', 64)->nullable();
            $table->string('mayor', 64)->nullable();
            $table->string('minor', 64)->nullable();
            $table->string('kesadaran3', 64)->nullable();
            $table->string('ket_kesadaran3', 64)->nullable();
            $table->string('keadaan_umum2', 64)->nullable();
            $table->string('bb2', 64)->nullable();
            $table->string('uraian_kepala', 64)->nullable();
            $table->string('ket_uraian_kepala', 64)->nullable();
            $table->string('uraian_mata', 64)->nullable();
            $table->string('ket_uraian_mata', 64)->nullable();
            $table->string('uraian_tht', 64)->nullable();
            $table->string('ket_uraian_tht', 64)->nullable();
            $table->string('uraian_mulut', 64)->nullable();
            $table->string('ket_uraian_mulut', 64)->nullable();
            $table->string('uraian_leher', 64)->nullable();
            $table->string('ket_uraian_leher', 64)->nullable();
            $table->string('uraian_thorax', 64)->nullable();
            $table->string('ket_uraian_thorax', 64)->nullable();
            $table->string('uraian_payudara', 64)->nullable();
            $table->string('ket_uraian_payudara', 64)->nullable();
            $table->string('uraian_abdomen', 64)->nullable();
            $table->string('ket_uraian_abdomen', 64)->nullable();
            $table->string('uraian_urogenital', 64)->nullable();
            $table->string('ket_uraian_urogenital', 64)->nullable();
            $table->string('uraian_ekstermitas', 64)->nullable();
            $table->string('uraian_kulit', 64)->nullable();
            $table->string('uraian_jantung', 64)->nullable();
            $table->string('saudara', 64)->nullable();
            $table->string('ket_kandung', 64)->nullable();
            $table->string('ket_tiri', 64)->nullable();
            $table->string('tinggal_bersama', 64)->nullable();
            $table->string('ket_tinggal_lainnya', 64)->nullable();
            $table->string('bicara', 64)->nullable();
            $table->string('komunikasi', 64)->nullable();
            $table->string('emosional', 64)->nullable();
            $table->string('gangguan_jiwa', 64)->nullable();
            $table->string('tahun_gangguan_jiwa', 64)->nullable();
            $table->string('riwayat_trauma', 64)->nullable();
            $table->string('ket_kriminal', 64)->nullable();
            $table->string('perasaan', 64)->nullable();
            $table->string('wawancara', 64)->nullable();
            $table->string('spiritual', 64)->nullable();
            $table->string('kebutuhan_spiritual', 64)->nullable();
            $table->string('bantuan_ibadah', 64)->nullable();
            $table->string('riwayat_alergi', 64)->nullable();
            $table->string('riwayat_alergi1', 64)->nullable();
            $table->string('reaksis1', 64)->nullable();
            $table->string('riwayat_alergi2', 64)->nullable();
            $table->string('reaksis2', 64)->nullable();
            $table->string('riwayat_alergi3', 64)->nullable();
            $table->string('reaksis3', 64)->nullable();
            $table->string('nyeri', 64)->nullable();
            $table->string('sifat_nyeri', 64)->nullable();
            $table->string('kualitas_nyeri', 64)->nullable();
            $table->string('nyeri_menjalar', 64)->nullable();
            $table->string('ket_nyeri_menjalar', 64)->nullable();
            $table->string('skor_nyeri', 64)->default('0');
            $table->string('frekuensi_nyeri', 64)->nullable();
            $table->string('pengaruh_nyeri', 64)->nullable();
            $table->string('nilai_wajah', 64)->nullable();
            $table->string('nilai_kaki', 64)->nullable();
            $table->string('nilai_aktifitas', 64)->nullable();
            $table->string('nilai_menangis', 64)->nullable();
            $table->string('nilai_bersuara', 64)->nullable();
            $table->string('faktor_pencetus', 64)->nullable();
            $table->string('kualitas', 64)->nullable();
            $table->string('lokasi', 64)->nullable();
            $table->string('skala_nyeri', 64)->nullable();
            $table->string('lama_nyeri', 64)->nullable();
            $table->string('resiko_jatuh_anak', 64)->nullable();
            $table->string('resiko_jatuh_dewasa', 64)->nullable();
            $table->string('resiko_jatuh', 64)->nullable();
            $table->string('bb_gizi', 64)->nullable();
            $table->string('pb_gizi', 64)->nullable();
            $table->string('imt_gizi', 64)->nullable();
            $table->string('tampak_kurus', 64)->nullable();
            $table->string('penurunan_bb', 64)->nullable();
            $table->string('asupan_makanan', 64)->nullable();
            $table->text('hasil_skrining_gizi')->nullable();
            $table->text('saran_skrining_gizi')->nullable();
            $table->string('sensorik_penglihatan', 64)->nullable();
            $table->string('sensorik_penciuman', 64)->nullable();
            $table->string('sensorik_pendengaran', 64)->nullable();
            $table->string('kognitif_satu', 64)->nullable();
            $table->string('motorik_satu', 64)->nullable();
            $table->string('motorik_dua', 64)->nullable();
            $table->string('saran_satu', 64)->nullable();
            $table->string('saran_dua', 64)->nullable();
            $table->string('saran_tiga', 64)->nullable();
            $table->text('hasil_discharge_planning')->nullable();
            $table->text('saran_discharge_planning')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smis_doc_dokumen_asesment_awal_keperawatan_igd');
    }
}
