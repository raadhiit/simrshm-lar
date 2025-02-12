<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReassesmentResikoJatuh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reassesment_resiko_jatuh', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('idx')->unsigned();

            $table->string('parameter', 200);
            $table->integer('tipe');

            $table->integer('ScoreParameter')->nullable();
            $table->integer('TotalScore1')->nullable();
            $table->integer('TotalScore2')->nullable();
            $table->integer('TotalScore3')->nullable();
            $table->integer('TotalScore4')->nullable();
            $table->integer('TotalScore5')->nullable();

            $table->integer('Score1')->nullable();
            $table->integer('Score2')->nullable();
            $table->integer('Score3')->nullable();
            $table->integer('Score4')->nullable();
            $table->integer('Score5')->nullable();

            $table->datetime('TanggalJam1')->nullable();
            $table->datetime('TanggalJam2')->nullable();
            $table->datetime('TanggalJam3')->nullable();
            $table->datetime('TanggalJam4')->nullable();
            $table->datetime('TanggalJam5')->nullable();

            $table->string('verifikator1')->nullable();
            $table->string('verifikator2')->nullable();
            $table->string('verifikator3')->nullable();
            $table->string('verifikator4')->nullable();
            $table->string('verifikator5')->nullable();

            $table->integer('status1')->nullable();
            $table->integer('status2')->nullable();
            $table->integer('status3')->nullable();
            $table->integer('status4')->nullable();
            $table->integer('status5')->nullable();

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
        Schema::dropIfExists('reassesment_resiko_jatuh');
    }
}
