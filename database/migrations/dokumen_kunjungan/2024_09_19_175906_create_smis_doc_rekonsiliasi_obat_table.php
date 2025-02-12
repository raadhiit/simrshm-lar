<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocRekonsiliasiObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_rekonsiliasi_obat', function (Blueprint $table) {
            $table->id();

            $table->integer('id_dokumen');

            $table->integer('id_obat')->default(0)->nullable();
            $table->text('nama_obat')->nullable();
            $table->text('dosis')->nullable();
            $table->text('aturan_pakai')->nullable();
            $table->text('cara_pemberian')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('pengobatan_admisi')->nullable();
            $table->text('tl_pengobatan_transfer')->nullable();
            $table->text('tl_pengobatan_discharge')->nullable();
            $table->text('perubahan_aturan_pakai')->nullable();

            $table->integer('id_apoteker')->nullable();
            $table->string('nama_apoteker', 256)->nullable();

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
        Schema::dropIfExists('smis_doc_rekonsiliasi_obat');
    }
}
