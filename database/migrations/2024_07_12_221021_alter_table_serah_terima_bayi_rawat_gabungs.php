<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSerahTerimaBayiRawatGabungs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serah_terima_bayi_rawat_gabungs', function (Blueprint $table) {
            $table->string('nama_mengetahui')->nullable()->change();
            $table->string('ttd_mengetahui')->nullable()->change();
            $table->string('nama_menerima')->nullable()->change();
            $table->string('ttd_menerima')->nullable()->change();
            $table->string('keluarga_penerima_bayi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serah_terima_bayi_rawat_gabungs', function (Blueprint $table) {
            //
        });
    }
}
