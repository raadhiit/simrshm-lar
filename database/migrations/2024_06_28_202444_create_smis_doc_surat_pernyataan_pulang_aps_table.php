<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratPernyataanPulangApsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_pernyataan_pulang_aps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->unsignedBigInteger('nrm');

            $table->string('nama_pasien')->nullable();
            $table->string('alamat_pasien')->nullable();
            $table->boolean('kelamin')->nullable();
            $table->date('tl_lahir_pasien')->nullable();

            $table->string('nama_kerabat', 128);
            $table->string('alamat_kerabat', 25);
            $table->string('hubungan', 128);
            $table->string('alasan', 128);
            $table->text('signature_kerabat')->nullable();
            $table->string('nama_saksi')->nullable();
            $table->text('signature_saksi')->nullable();
            $table->string('nama_saksi_2')->nullable();
            $table->text('signature_saksi_2')->nullable();

            $table->timestamp('tanggal');
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
        Schema::dropIfExists('smis_doc_surat_pernyataan_pulang_aps');
    }
}
