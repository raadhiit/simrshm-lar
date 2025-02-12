<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocDokumenLaporanCaesarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            $table->string('dilahirkan_dengan')->default('');
            $table->string('isian_tubae')->default('');
            $table->string('isian_ovarium_kiri')->default('');
            $table->string('isian_ovarium_kanan')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            //
        });
    }
}
