<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmenAwalKeperawatanGeriatriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesmen_awal_keperawatan_geriatri', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('ruangan', 64);
            $table->string('kelas', 64);
            $table->integer('id_dokter_pengirim')->unsigned();
            $table->string('dokter_pengirim', 64);
            $table->integer('id_dokter_merawat')->unsigned();
            $table->string('dokter_merawat', 64);
            $table->date('tgl_masuk')->nullable();
            $table->string('pendidikan', 32);
            $table->datetime('tgl_pengkajian')->nullable();
            $table->string('pekerjaan', 32);
            $table->string('diagnosis_medik', 128);
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->string('kondisi_saat_masuk', 64);
            $table->string('kondisi_saat_masuk_lain', 64);
            $table->string('telpon', 32);
            $table->string('data_diperoleh', 32);
            $table->string('hubungan', 32);
            $table->string('asal_pasien', 32);
            $table->string('bahasa', 32);
            $table->text('keluhan_utama');
            $table->text('keluhan_menyertai');
            $table->datetime('waktu_pengobatan_terakhir');
            $table->string('tempat_pengobatan_terakhir', 128);
            $table->string('riwayat_alergi', 128);
            $table->string('reaksi', 32);
            $table->text('riwayat_penyakit_dahulu');
            $table->text('riwayat_imuno');
            $table->text('riwayat_penyakit_keluarga');
            $table->text('pernah_dirawat');
            $table->text('pernah_operasi');
            $table->string('nyeri');
            $table->string('ttv');
            $table->text('glasglow_coma');
            $table->string('kepala');
            $table->string('rambut');
            $table->string('muka');
            $table->string('mata');
            $table->string('telinga');
            $table->string('hidung');
            $table->string('mulut');
            $table->string('gigi');
            $table->string('lidah');
            $table->string('tenggorokan');
            $table->string('leher');
            $table->string('dada');
            $table->string('abdomen');
            $table->text('genitalia_wanita');
            $table->text('genitalia_pria');
            $table->text('integumen');
            $table->string('kondisi');
            $table->string('balutan');
            $table->text('ekstremitas');
            $table->text('obat_dirumah');
            $table->string('resiko_cidera_jatuh');
            $table->string('kesimpulan_resiko_jatuh');
            $table->string('tindakan_resiko_jatuh');
            $table->string('resiko_dekubitus');
            $table->string('kesimpulan_resiko_dekubitus');
            $table->string('nutrisi');
            $table->string('rujuk_ahli_gizi',32);
            $table->text('status_fungsional');
            $table->string('kesimpulan_status_fungsional');
            $table->string('perlu_bantuan');
            $table->string('alat_bantu');
            $table->text('kebutuhan_komunikasi');
            $table->string('status_ekonomi');
            $table->text('riwayat_psikisosial');
            $table->text('pola_aktivitas');
            $table->text('pola_kebiasaan');
            $table->text('ketergantungan_zat');
            $table->text('data_penunjang');
            $table->text('orientasi_pada_pasien');
            $table->text('informasi_pada_pasien');
            $table->text('penggunaan_alat_medik');
            $table->text('masalah_keperawatan');
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
        Schema::dropIfExists('smis_doc_asesmen_awal_keperawatan_geriatri');
    }
}
