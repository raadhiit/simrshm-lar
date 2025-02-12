<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPersetujuanAtauPenolakanTindakanKedokteransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('penerima_informasi', 128)->nullable();
            $table->date('tanggal')->nullable();
            $table->time('pukul')->nullable();
            $table->string('diagnosa', 128)->nullable();
            $table->string('checkbox_diagnosa')->nullable();
            $table->string('dasar_diagnosis', 128)->nullable();
            $table->string('checkbox_dasar_diagnosis')->nullable();
            $table->string('tindakan_kedokteran', 128)->nullable();
            $table->string('checkbox_tindakan_kedokteran')->nullable();
            $table->string('indikasi_tindakan', 128)->nullable();
            $table->string('checkbox_indikasi_tindakan')->nullable();
            $table->string('tata_cara', 128)->nullable();
            $table->string('checkbox_tata_cara')->nullable();
            $table->string('tujuan', 128)->nullable();
            $table->string('checkbox_tujuan')->nullable();
            $table->string('risiko', 128)->nullable();
            $table->string('checkbox_risiko')->nullable();
            $table->string('komplikasi', 128)->nullable();
            $table->string('checkbox_komplikasi')->nullable();
            $table->string('prognosis', 128)->nullable();
            $table->string('checkbox_prognosis')->nullable();
            $table->string('alternatif', 128)->nullable();
            $table->string('checkbox_alternatif')->nullable();
            $table->string('hal_lain', 128)->nullable();
            $table->string('checkbox_hal_lain')->nullable();
            $table->integer('id_verifikator')->unsigned();
            $table->string('nama_verifikator', 64);

            $table->string('nama', 64)->nullable();
            $table->string('pekerjaan', 64)->nullable();
            $table->string('alamat', 128)->nullable();
            $table->string('umur', 64)->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('no_ktp', 32)->nullable();
            $table->string('telepon', 16)->nullable();
            $table->string('menyatakan')->nullable();
            $table->string('pernyataan', 128)->nullable();
            $table->string('hubungan_dengan_pasien')->nullable();
            $table->string('lain_lain', 16)->nullable();

            $table->string('nama_yang_menyatakan', 64)->nullable();
            $table->string('nama_dokter', 64)->nullable();
            $table->string('saksi_satu', 64)->nullable();
            $table->string('saksi_dua', 64)->nullable();

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
        Schema::dropIfExists('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans');
    }
}
