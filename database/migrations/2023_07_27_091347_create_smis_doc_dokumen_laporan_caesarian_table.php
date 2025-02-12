<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDokumenLaporanCaesarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('id_d_operator');
            $table->string('d_operator', 64);
            $table->integer('id_a_operator');
            $table->string('a_operator', 64);
            $table->integer('id_instrumen');
            $table->string('instrumen', 64);
            $table->integer('id_d_anastesi');
            $table->string('d_anastesi', 64);
            $table->integer('id_a_anastesi');
            $table->string('a_anastesi', 64);
            $table->string('jenis_anastesi');
            $table->string('tindakan');
            $table->string('indikasi_operasi');
            $table->string('posisi');
            $table->string('jenis_pembedahan');
            $table->string('jenis_pembedahan2');
            $table->string('jenis_luka_operasi');
            $table->string('tanggal');
            $table->string('mulai');
            $table->string('selesai');
            $table->string('lama_pembedahan');
            $table->string('catatan')->nullable();
            $table->string('air_ketuban')->nullable();
            $table->string('jumlah_air_ketuban')->nullable();
            $table->string('bayi')->nullable();
            $table->string('bb1')->nullable();
            $table->string('pb1')->nullable();
            $table->string('as1')->nullable();
            $table->string('kelamin1')->nullable();
            $table->string('ket_plasenta')->nullable();
            $table->string('lahir_dengan')->nullable();
            $table->string('kelainan')->nullable();
            $table->string('ket_sbu_jahit')->nullable();
            $table->string('tubae')->nullable();
            $table->string('ovarium_kiri')->nullable();
            $table->string('ovarium_kanan')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('det_jumlah')->nullable();
            $table->string('ket_jumlah')->nullable();
            $table->string('ket_pendarahan')->nullable();
            $table->string('no_batch');
            $table->string('komplikasi');
            $table->string('pendarahan');
            $table->string('dikirim_pa');
            $table->string('asal_jaringan');
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
        Schema::dropIfExists('smis_doc_dokumen_laporan_caesarian');
    }
}
