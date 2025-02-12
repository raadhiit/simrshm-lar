<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocRencanaKeperawatanIntraOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_rencana_keperawatan_intra_operasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->text('assessment')->nullable();
            $table->text('diagnosa_keperawatan')->nullable();
            $table->text('rencana_keperawatan')->nullable();
            $table->text('implementasi')->nullable();
            $table->text('evaluasi')->nullable();
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
        Schema::dropIfExists('smis_doc_rencana_keperawatan_intra_operasi');
    }
}
