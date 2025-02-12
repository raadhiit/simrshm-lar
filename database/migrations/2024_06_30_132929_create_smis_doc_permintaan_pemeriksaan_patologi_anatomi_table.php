<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SmisDocPermintaanPemeriksaanPatologiAnatomi;

class CreateSmisDocPermintaanPemeriksaanPatologiAnatomiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_permintaan_pemeriksaan_patologi_anatomi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->string('nama_pasien')->nullable();
            $table->boolean('kelamin_pasien')->nullable();
            $table->string('jaminan')->nullable();

            $table->unsignedBigInteger('id_dpjp')->nullable();
            $table->string('dpjp')->default('');
            $table->string('no_pa', 64);
            $table->timestamp('tgl_pemeriksaan');

            $table->string('pemeriksaan_jaringan_tubuh');
            $table->string('jaringan_tubuh_didapat_dari');
            $table->string('lokasi_jaringan_tubuh', 128);
            $table->string('diagnosa_klinik', 128);
            $table->text('keterangan_klinik');

            $table->timestamp('tanggal');
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
        Schema::dropIfExists('smis_doc_permintaan_pemeriksaan_patologi_anatomi');
    }
}
