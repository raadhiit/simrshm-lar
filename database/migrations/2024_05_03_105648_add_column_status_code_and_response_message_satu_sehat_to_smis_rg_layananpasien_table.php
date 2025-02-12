<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusCodeAndResponseMessageSatuSehatToSmisRgLayananpasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_rg_layananpasien', function (Blueprint $table) {
            $table->string('response_code_satu_sehat');
            $table->string('response_message_satu_sehat');
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
