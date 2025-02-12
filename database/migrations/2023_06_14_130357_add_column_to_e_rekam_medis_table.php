<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToERekamMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_rekam_medis_pasien', function (Blueprint $table) {
            $table->timestamp('tanggal_update');
            $table->string('signature_pasien', 64)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_rekam_medis', function (Blueprint $table) {
            //
        });
    }
}
