<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocCatatanEdukasiPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_edukasi_pasien', function (Blueprint $table) {
            $table->string('sarana_edukasi', 64)->default('');
            $table->string('sarana_edukasi_lain', 64)->default('');
            $table->string('penerima_edukasi', 64)->default('');
            $table->string('penerima_edukasi_lain', 64)->default('');
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
