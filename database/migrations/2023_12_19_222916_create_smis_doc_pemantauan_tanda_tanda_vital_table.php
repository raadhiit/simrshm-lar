<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPemantauanTandaTandaVitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_pemantauan_tanda_tanda_vital', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->json('checklist')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('lingkar_kepala')->nullable();
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
        Schema::dropIfExists('smis_doc_pemantauan_tanda_tanda_vital');
    }
}
