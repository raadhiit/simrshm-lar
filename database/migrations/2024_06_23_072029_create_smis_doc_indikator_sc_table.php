<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocIndikatorScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_indikator_sc', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_dokumen')->unsigned();
            $table->string('sc_satu');
            $table->string('sc_dua');
            $table->string('sc_tiga');
            $table->string('sc_empat');
            $table->string('sc_lima');
            $table->string('sc_enam');
            $table->string('sc_tujuh');
            $table->string('sc_delapan');
            $table->string('sc_sembilan');
            $table->string('sc_sepuluh');
            $table->string('sc_sebelas');
            $table->string('sc_duabelas');
            $table->string('sc_tigabelas');
            $table->string('sc_empatbelas');
            $table->string('sc_limabelas');
            $table->boolean('sc_enambelas_a')->default(false);
            $table->boolean('sc_enambelas_b')->default(false);
            $table->boolean('sc_enambelas_c')->default(false);
            $table->boolean('sc_enambelas_d')->default(false);
            $table->boolean('sc_enambelas_e')->default(false);
            $table->boolean('sc_enambelas_f')->default(false);
            $table->boolean('sc_enambelas_g')->default(false);
            $table->boolean('sc_enambelas_h')->default(false);
            $table->boolean('sc_enambelas_i')->default(false);
            $table->boolean('sc_enambelas_j')->default(false);
            $table->boolean('sc_tujuhbelas_a')->default(false);
            $table->boolean('sc_tujuhbelas_b')->default(false);
            $table->boolean('sc_tujuhbelas_c')->default(false);
            $table->boolean('sc_tujuhbelas_d')->default(false);
            $table->boolean('sc_tujuhbelas_e')->default(false);
            $table->boolean('sc_tujuhbelas_f')->default(false);
            $table->boolean('sc_tujuhbelas_g')->default(false);
            $table->boolean('sc_tujuhbelas_h')->default(false);
            $table->text('sc_tujuhbelas_i')->nullable();
            $table->string('luaran_satu');
            $table->string('luaran_dua');
            $table->string('luaran_tiga');
            $table->string('luaran_empat');
            $table->string('luaran_lima');
            $table->string('luaran_enam');
            $table->string('luaran_tujuh');
            $table->string('luaran_delapan');
            $table->string('luaran_sembilan');
            $table->string('luaran_sepuluh');
            $table->string('luaran_sebelas');
            $table->string('luaran_duabelas');
            $table->string('luaran_tigabelas');
            $table->date('tanggal');
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
        Schema::dropIfExists('smis_doc_indikator_sc');
    }
}
