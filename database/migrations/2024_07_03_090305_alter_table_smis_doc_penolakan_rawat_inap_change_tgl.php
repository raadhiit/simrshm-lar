<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSmisDocPenolakanRawatInapChangeTgl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_penolakan_rawat_inap', function (Blueprint $table) {
            $table->string('tgl_lahir_pasien', 64)->nullable()->change();
            $table->string('tgl_lahir_kerabat', 64)->nullable()->change();
            $table->string('tempat_lahir_kerabat', 64)->nullable();
            $table->string('tempat_lahir_pasien', 64)->nullable();
            $table->string('kelamin', 64)->nullable();
            $table->string('tanggal', 20)->nullable()->change();
            $table->string('jam', 20)->nullable();
            $table->integer('id_dokter')->nullable();
            $table->string('nama_dokter', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_penolakan_rawat_inap', function (Blueprint $table) {
            //
        });
    }
}
