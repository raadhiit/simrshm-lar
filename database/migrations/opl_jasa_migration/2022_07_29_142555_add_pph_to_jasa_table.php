<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPphToJasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_p_l_jasas', function (Blueprint $table) {
            $table->integer('pph')->after('ppn');
            $table->integer('jml_pph')->after('jml_ppn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_p_l_jasas', function (Blueprint $table) {
            $table->dropColumn('pph'); 
            $table->dropColumn('jml_pph'); 
        });
    }
}
