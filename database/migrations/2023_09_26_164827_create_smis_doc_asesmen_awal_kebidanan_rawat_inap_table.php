<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmenAwalKebidananRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesmen_awal_kebidanan_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('ruangan', 128);
            $table->string('dpjp', 128);
            $table->string('caradatang_ruangan', 64);
            $table->string('rujukan', 128);
            $table->string('rujukan_lain', 128);
            $table->string('caradatang', 64);
            $table->string('riwayat_alergi', 32);
            $table->string('riwayat_alergi_ada', 128);
            $table->string('nyeri', 32);
            $table->string('skor_nyeri', 32);
            $table->string('skrining_satu', 64);
            $table->string('penurunan_bb', 64);
            $table->string('skrining_dua', 64);
            $table->string('skor_risiko_jatuh', 32);
            $table->string('menarche', 32);
            $table->string('siklus', 32);
            $table->string('teratur_menarche', 32);
            $table->string('lama_hari_menarche', 32);
            $table->string('keluhan', 64);
            $table->string('keluhan_lain', 128);
            $table->string('hpht', 128);
            $table->string('hpl', 128);
            $table->string('uk', 128);
            $table->string('menikah', 64);
            $table->string('jumlah_pernikahan', 128);
            $table->string('usia_pernikahan', 32);
            $table->string('keluarga_terdekat', 128);
            $table->string('hubungan', 128);
            $table->string('tinggal_dengan', 32);
            $table->string('tinggal_dengan_lain', 128);
            $table->string('curiga', 32);
            $table->string('ibadah', 128);
            $table->string('status_emosional', 64);
            $table->string('g', 128);
            $table->string('p', 128);
            $table->string('a', 128);
            $table->text('riwayat_kehamilan');
            $table->string('riwayat_penyakit_dahulu', 128);
            $table->string('riwayat_operasi', 128);
            $table->string('tahun_operasi', 32);
            $table->string('riwayat_penyakit_keluarga', 128);
            $table->string('riwayat_ginekologi', 64);
            $table->string('riwayat_ginekologi_lain', 128);
            $table->string('flour_albus', 32);
            $table->string('berbau', 32);
            $table->string('warna', 64);
            $table->text('metode_kb');
            $table->string('komplikasi_kb', 64);
            $table->string('komplikasi_kb_lain', 128);
            $table->string('bak', 32);
            $table->string('bab', 32);
            $table->string('warna_eliminasi', 64);
            $table->string('karakteristik', 64);
            $table->string('tidur_malam', 32);
            $table->string('tidur_siang', 32);
            $table->string('kepala', 64);
            $table->string('kepala_lain', 128);
            $table->string('rambut', 32);
            $table->string('muka', 32);
            $table->string('mata', 64);
            $table->string('hidung', 32);
            $table->string('telinga', 32);
            $table->string('mulut', 32);
            $table->string('mulut_lain', 128);
            $table->string('leher', 64);
            $table->string('dada', 64);
            $table->string('payudara', 64);
            $table->string('payudara_lain', 128);
            $table->string('abdomen', 64);
            $table->string('abdomen_lain', 128);
            $table->string('inspeksi', 64);
            $table->string('inspeksi_lain', 128);
            $table->text('palpasi');
            $table->string('obstetri', 64);
            $table->string('tfu', 128);
            $table->string('tfj', 128);
            $table->string('his', 128);
            $table->string('teratur_his', 64);
            $table->string('durasi', 128);
            $table->string('kriteria_durasi', 64);
            $table->string('djj', 128);
            $table->string('kriteria_djj', 64);
            $table->string('inspeksi_genitalia', 64);
            $table->string('banyaknya', 64);
            $table->string('konsistensi', 64);
            $table->string('inspekulo', 64);
            $table->string('inspekulo_lain', 128);
            $table->string('uretra', 32);
            $table->string('vulva', 64);
            $table->string('vagina', 32);
            $table->string('portio', 32);
            $table->string('pembukaan', 64);
            $table->string('selaput', 64);
            $table->string('srld', 128);
            $table->string('mekonium', 128);
            $table->string('bg_terendah', 128);
            $table->string('uuk', 128);
            $table->string('penurunan', 32);
            $table->string('pecah_ketuban', 32);
            $table->string('bishope', 32);
            $table->string('ekstremitas', 128);
            $table->string('diagnosa_kebidanan', 128);
            $table->text('rencana');
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
        
    }
}
