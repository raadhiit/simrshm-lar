<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalOperasiRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_operasi_rs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kodebooking', 50);
            $table->date('tanggaloperasi');
            $table->text('jenistindakan');
            $table->string('kodepoli', 50);
            $table->string('namapoli');
            $table->integer('terlaksana');
            $table->text('nopeserta');
            $table->dateTime('lastupdate');
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
        Schema::dropIfExists('jadwal_operasi_rs');
    }
}
