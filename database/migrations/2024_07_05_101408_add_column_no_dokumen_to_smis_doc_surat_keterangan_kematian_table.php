<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNoDokumenToSmisDocSuratKeteranganKematianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_surat_keterangan_kematian', function (Blueprint $table) {
            $table->string('no_dokumen', 64)->nullable();
            $table->string('bulan', 64)->nullable();
            $table->string('tahun', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_surat_keterangan_kematian', function (Blueprint $table) {
            //
        });
    }
}
