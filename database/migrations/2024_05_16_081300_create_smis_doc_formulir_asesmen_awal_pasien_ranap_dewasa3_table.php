<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirAsesmenAwalPasienRanapDewasa3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa3', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->text('spiritual')->nullable();
            $table->string('agama_lain', 15)->nullable();
            $table->string('checkbox_spiritual')->nullable();
            $table->string('ket_keprihatinan_detail', 100)->nullable();
            $table->string('pekerjaan_lain', 64)->nullable();
            $table->string('tinggal_bersama_lain', 64)->nullable();
            $table->string('pendidikan_pasien_lain', 64)->nullable();
            $table->string('pendidikan_pj_lain', 64)->nullable();
            $table->string('suku', 64)->nullable();
            $table->text('proteksi')->nullable();
            $table->string('ket_status_psikologis', 64)->nullable();
            $table->string('skor')->nullable();
            $table->string('total_skor', 10)->nullable();
            $table->text('pengkajian_fungsi')->nullable();
            $table->string('ket_patah_tulang', 64)->nullable();
            $table->string('ket_berjalan', 64)->nullable();
            $table->string('ket_edema', 64)->nullable();
            $table->string('ket_ekstremitas_bawah', 64)->nullable();
            $table->string('ket_kemampuan_menggenggam', 64)->nullable();
            $table->string('ket_kemampuan_koordinasi', 64)->nullable();
            $table->text('kebutuhan_komunikasi')->nullable();
            $table->string('ket_gangguan_bicara', 64)->nullable();
            $table->string('ket_bahasa_daerah', 64)->nullable();
            $table->string('ket_pendidikan_bahasa', 64)->nullable();
            $table->string('ket_bahasa_penerjemah', 64)->nullable();
            $table->string('ket_detail_hambatan_belajar', 64)->nullable();
            $table->string('ket_informasi_tentang', 64)->nullable();
            $table->text('kebutuhan_privasi_pasien')->nullable();
            $table->string('ket_tempat_khusus', 64)->nullable();
            $table->string('ket_privasi_lain_lain', 64)->nullable();

            $table->text('skrining_gizi_perawat')->nullable();
            $table->text('kelainan_pasien')->nullable();
            $table->text('masalah_keperawatan')->nullable();
            $table->string('ket_masalah_keperawatan', 64)->nullable();
            $table->string('rencana_keperawatan_satu')->nullable();
            $table->string('rencana_keperawatan_dua')->nullable();
            $table->string('rencana_keperawatan_tiga')->nullable();
            $table->string('rencana_keperawatan_empat')->nullable();
            $table->string('rencana_keperawatan_lima')->nullable();
            $table->string('rencana_keperawatan_enam')->nullable();
            $table->string('rencana_keperawatan_tujuh')->nullable();
            $table->string('ket_diet_nutrisi', 64)->nullable();
            $table->string('ket_rehab_medik', 64)->nullable();
            $table->string('ket_farmasi', 64)->nullable();
            $table->string('ket_perawatan_luka', 64)->nullable();
            $table->string('ket_manajemen_nyeri', 64)->nullable();
            $table->string('perencanaan_perawatan_lain_lain')->nullable();

            $table->string('info_perencanaan_pulang', 21)->nullable();
            $table->string('kondisi_pulang')->nullable();
            $table->string('lama_perawatan')->nullable();
            $table->string('tgl_rencana_pulang', 21)->nullable();
            $table->text('perawatan_lanjutan')->nullable();
            $table->string('ket_perencanaan_pulang')->nullable();
            $table->text('transportasi_pulang')->nullable();
            $table->string('transportasi_digunakan_pulang')->nullable();
            $table->string('barang_milik_pasien')->nullable();
            $table->string('ket_barang_tidak_lengkap')->nullable();
            $table->string('jam_pengkajian', 20)->nullable();
            $table->string('tgl_pengkajian', 20)->nullable();

            $table->string('td', 64)->nullable();
            $table->string('rr', 64)->nullable();
            $table->string('nadi', 64)->nullable();
            $table->string('suhu', 64)->nullable();
            $table->string('bb', 64)->nullable();
            $table->string('tb', 64)->nullable();
            $table->string('lingkar_kepala', 64)->nullable();
            $table->string('lingkar_dada', 64)->nullable();
            $table->string('lingkar_perut', 64)->nullable();
            $table->string('alkohol')->nullable();
            $table->string('anti_kejang')->nullable();
            $table->string('narkotik')->nullable();
            $table->string('psikotropik')->nullable();
            $table->integer('id_verifikator')->unsigned();
            $table->string('nama_verifikator', 64);
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
        Schema::dropIfExists('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa3');
    }
}
