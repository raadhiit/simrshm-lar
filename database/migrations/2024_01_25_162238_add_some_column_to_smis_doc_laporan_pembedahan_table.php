<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocLaporanPembedahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_laporan_pembedahan', function (Blueprint $table) {
            $table->string('no_batch')->default('');
            $table->string('komplikasi')->default('');
            $table->string('pendarahan')->default('');
            $table->string('asal_jaringan')->default('');
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
