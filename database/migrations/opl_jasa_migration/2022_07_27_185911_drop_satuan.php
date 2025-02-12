<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSatuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_p_l_jasa_details', function ($table) {
            $table->dropColumn('konversi');
            $table->dropColumn('satuan_konversi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('o_p_l_jasa_details', function ($table) {
            $table->string('konversi');
            $table->string('satuan_konversi');
        });
    }
}
