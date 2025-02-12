<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToPersetujuanPenolakanTindakanKedokteran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans', function (Blueprint $table) {
            $table->string('signature_nama_yang_menyatakan', 64)->nullable();
            $table->string('signature_saksi_satu', 64)->nullable();
            $table->string('signature_saksi_dua', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans', function (Blueprint $table) {
            //
        });
    }
}
