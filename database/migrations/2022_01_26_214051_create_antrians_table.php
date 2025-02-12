<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger("taskid");
            $table->bigInteger("jadwal_id");
            $table->date("tanggalperiksa");
            $table->string("nomorantrean", 20);
            $table->integer("angkaantrean");
            $table->string("kodebooking", "");
            $table->integer("norm");
            $table->string("namapoli");
            $table->string("namadokter");
            $table->string("estimasidilayani");
            $table->integer("sisakuotajkn");
            $table->integer("kuotajkn");
            $table->integer("sisakuotanonjkn");
            $table->integer("kuotanonjkn");
            $table->text("keterangan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrians');
    }
}
