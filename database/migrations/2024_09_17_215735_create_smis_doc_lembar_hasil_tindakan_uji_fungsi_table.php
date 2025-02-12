<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLembarHasilTindakanUjiFungsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_lembar_hasil_tindakan_uji_fungsi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('lembar_hasil')->nullable();
            $table->string('koding')->nullable();
            $table->string('tanggal_pemeriksaan')->nullable();
            $table->string('diagnosis_fungsional')->nullable();
            $table->string('diagnosis_medis')->nullable();
            $table->string('hasil')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('rekomendasi')->nullable();
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
        Schema::dropIfExists('smis_doc_lembar_hasil_tindakan_uji_fungsi');
    }
}
