<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmenPasienTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesmen_pasien_terminal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_pengkajian', 64)->nullable();
            $table->string('informasi', 64)->nullable();
            $table->string('hubungan', 64)->nullable();
            $table->string('ket_tonus_otot', 64)->nullable();
            $table->string('ket_checkbox4', 64)->nullable();
            $table->string('ket_orientasi_spiritual', 64)->nullable();
            $table->string('nama_keluarga', 64)->nullable();
            $table->string('hubungan_keluarga', 64)->nullable();
            $table->string('dimana', 64)->nullable();
            $table->string('telp', 64)->nullable();
            $table->string('ket_mampu_merawat', 64)->nullable();
            $table->string('ket_checkbox9', 64)->nullable();
            $table->string('donasi_organ', 64)->nullable();
            $table->text('checkbox1')->nullable();
            $table->text('checkbox2')->nullable();
            $table->text('checkbox3')->nullable();
            $table->text('checkbox4')->nullable();
            $table->text('checkbox5')->nullable();
            $table->text('checkbox6')->nullable();
            $table->text('checkbox7')->nullable();
            $table->text('checkbox8')->nullable();
            $table->text('checkbox9')->nullable();
            $table->text('checkbox10')->nullable();
            $table->text('checkbox11')->nullable();
            $table->text('checkbox12')->nullable();
            $table->string('tonus_otot', 64)->nullable();
            $table->string('orientasi_spiritual', 64)->nullable();
            $table->string('perlu_didoakan', 64)->nullable();
            $table->string('perlu_bimbingan', 64)->nullable();
            $table->string('pendampingan_rohani', 64)->nullable();
            $table->string('keluarga', 64)->nullable();
            $table->string('penyiapan_lingkungan', 64)->nullable();
            $table->string('mampu_merawat', 64)->nullable();
            $table->string('homecare', 64)->nullable();
            $table->integer('id_perawat')->nullable();
            $table->string('nama_perawat', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_asesmen_pasien_terminal');
    }
}
