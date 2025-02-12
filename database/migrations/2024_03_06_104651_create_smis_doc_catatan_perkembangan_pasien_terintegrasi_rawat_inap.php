<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocCatatanPerkembanganPasienTerintegrasiRawatInap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('jenis_ppa', 10);
            $table->dateTime('tanggal');
            $table->integer('id_lab')->default(0);
            $table->integer('id_rad')->default(0);
            $table->integer('id_resep')->default(0);
            $table->integer('id_ttv')->default(0);
            $table->integer('id_ppa')->default(0);
            $table->string('nama_ppa', 64)->default('');
            $table->integer('id_verifikator')->default(0);
            $table->string('nama_verifikator', 64)->default('');
            $table->string('subjective')->default('');
            $table->string('objective_lain')->default('');
            $table->string('asesmen')->default('');
            $table->string('catatan_asesmen')->default('');
            $table->string('planning')->default('');
            $table->string('tindak_lanjut')->default('');
            $table->string('instruksi')->default('');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap');
    }
}
