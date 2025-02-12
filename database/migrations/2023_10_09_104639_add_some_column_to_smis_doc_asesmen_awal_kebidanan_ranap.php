<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocAsesmenAwalKebidananRanap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_kebidanan_rawat_inap', function (Blueprint $table) {
            $table->string('kesadaran',64)->default('');
            $table->string('tb',32)->default('');
            $table->string('gcs_e', 64)->default('');
            $table->string('gcs_v', 64)->default('');
            $table->string('gcs_m', 64)->default('');
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
