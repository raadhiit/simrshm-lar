
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormPemantauanReaksiTransfusiDarahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_form_pemantauan_reaksi_transfusi_darah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->date('tanggal_transfusi');
            $table->string('nama_pasien', 64)->default('');
            $table->date('tanggal_lahir');
            $table->string('umur', 64)->default('');
            $table->string('nrm', 32)->default('');
            $table->string('nrm_sesuai', 32)->default('');
            $table->string('kelamin', 32)->default('');
            $table->string('nama_dokter_pj', 64)->default('');
            $table->string('berat_badan_kg', 32)->default('');
            $table->string('berat_badan_gr', 32)->default('');
            $table->string('ruangan', 64)->default('');
            $table->string('golongan_darah', 32)->default('');
            $table->string('riwayat_transfusi_sebelumnya', 32)->default('');
            $table->date('tanggal_transfusi_sebelumnya');
            $table->text('riwayat_kehamilan')->nullable();
            $table->string('riwayat_penyakit_berkaitan', 128)->default('');
            $table->text('jenis_komponen_darah')->nullable();
            $table->string('volume_unit', 64)->default('');
            $table->string('no_kantong_darah', 64)->default('');
            $table->date('tanggal_kadaluwarsa');
            $table->string('golongan_darah_donor', 32)->default('');
            $table->string('cross_match', 32)->default('');
            $table->string('kompatibel', 32)->default('');
            $table->string('skrining_antibodi', 32)->default('');
            $table->string('hasil_skrining_antibodi', 32)->default('');
            $table->text('masalah')->nullable();
            $table->string('petugas_satu', 64)->default('');
            $table->string('petugas_dua', 64)->default('');
            $table->string('jam_mulai', 32)->default('');
            $table->string('jam_berakhir', 32)->default('');
            $table->string('kecepatan_tetesan', 128)->default('');
            $table->text('tanda_vital')->nullable();
            $table->text('gejala')->nullable();            
            $table->text('lain_lain')->nullable();
            $table->string('nama_dokter', 64)->default('');
            $table->string('nama_perawat', 64)->default('');
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
        Schema::dropIfExists('smis_doc_form_pemantauan_reaksi_transfusi_darah');
    }
}
