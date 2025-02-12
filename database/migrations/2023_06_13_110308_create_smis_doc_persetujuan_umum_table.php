<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPersetujuanUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_persetujuan_umum', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('identitas')->nullable();
            $table->string('nomer_identitas', 64)->nullable();
            $table->string('kebangsaan', 64)->nullable();
            $table->string('nama_wali', 64)->nullable();
            $table->string('hubungan_pasien', 64)->nullable();
            $table->string('alamat_wali',255)->nullable();
            $table->string('telpon', 20)->nullable();
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
        Schema::dropIfExists('smis_doc_persetujuan_umum');
    }
}
