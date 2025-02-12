<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocRenprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_renpras', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('nama_renpra', 256);
            $table->dateTime('tanggal')->nullable();
            $table->text('diagnosa_keperawatan')->nullable();
            $table->json('do')->nullable();
            $table->json('ds')->nullable();
            $table->text('lama_tindakan')->nullable();
            $table->json('kriteria_hasil')->nullable();
            $table->json('intervensi')->nullable();
            $table->time('jam')->nullable();
            $table->text('implementasi')->nullable();
            $table->string('verifikator', 128)->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('smis_doc_renpras');
    }
}
