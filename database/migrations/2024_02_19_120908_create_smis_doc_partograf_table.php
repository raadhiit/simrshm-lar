<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPartografTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_partograf', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('noreg', 32)->default('');
            $table->string('nama_ibu', 64)->default('');
            $table->string('umur', 10)->default('');
            $table->string('g', 32)->default('');
            $table->string('p', 32)->default('');
            $table->string('a', 32)->default('');
            $table->string('nomor_puskesmas', 32)->default('');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->string('alamat', 128)->default('');
            $table->time('ketuban_pecah_jam')->nullable();
            $table->time('mutes_jam')->nullable();
            $table->string('gambar', 128)->default('');
            $table->date('tanggal_persalinan')->nullable();
            $table->integer('id_bidan')->unsigned();
            $table->string('nama_bidan', 64)->default('');
            $table->string('tempat_persalinan', 64)->default('');
            $table->string('tempat_persalinan_lain', 64)->default('');
            $table->string('alamat_tempat_persalinan', 64)->default('');
            $table->string('rujuk', 10)->default('');
            $table->string('kala', 10)->default('');
            $table->string('alasan_merujuk', 64)->default('');
            $table->string('tempat_rujukan', 64)->default('');
            $table->string('pendamping', 64)->default('');
            $table->text('kala_i');
            $table->text('kala_ii');
            $table->text('kala_iii');
            $table->text('kala_iv');
            $table->text('bayi_baru_lahir');
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
