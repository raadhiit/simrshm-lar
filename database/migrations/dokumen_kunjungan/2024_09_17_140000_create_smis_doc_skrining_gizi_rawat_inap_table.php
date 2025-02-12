<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSkriningGiziRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_skrining_gizi_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');

            $table->text('alamat');
            $table->text('pekerjaan');
            $table->text('peran');
            $table->text('mobilitas');
            $table->text('riwayat_medis');
            $table->text('diagnosa_medis');
            $table->text('dengan_siapa');
            $table->text('keluhan_makan');
            $table->text('bb');
            $table->text('pbtb');
            $table->text('imt');
            $table->text('lla');
            $table->text('kesimpulan_antropemetri');
            $table->text('kesimpulan_biokimia');
            $table->text('keadaan');
            $table->text('td');
            $table->text('n');
            $table->text('rr');
            $table->text('t');
            $table->text('recall');
            $table->text('ni');
            $table->text('nc');
            $table->text('nb');
            $table->text('terapi_gizi');
            $table->text('jenis_makanan');
            $table->text('rute');
            $table->text('jadwal_pemberian');
            $table->text('edukasi_gizi');
            $table->text('perhitungan_kebutuhan');
            $table->text('e');
            $table->text('p');
            $table->text('l');
            $table->text('kh');
            $table->text('monitoring_evaluasi_gizi');
            $table->text('dietisien');


            $table->tinyInteger('kemampuan_baca');
            $table->tinyInteger('alergi_makan');
            $table->tinyInteger('tidak_suka');
            $table->tinyInteger('pengalaman_diet');
            $table->tinyInteger('hilang_lemak');
            $table->tinyInteger('edema');
            $table->tinyInteger('keterbatasan_fisik');
            
            
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
        Schema::dropIfExists('smis_doc_skrining_gizi_rawat_inap');
    }
}
