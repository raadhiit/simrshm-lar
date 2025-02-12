<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenerimaDaftarTilikPasienOperasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('smis_doc_daftar_tilik_pasien_operasi')) {
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->string('nama_penerima')->after('nama_pelaksana')->nullable();
                $table->unsignedBigInteger('id_penerima')->after('nama_pelaksana')->nullable();
                $table->boolean('status_penerima')->after('nama_pelaksana')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('smis_doc_daftar_tilik_pasien_operasi', ['nama_penerima', 'id_penerima', 'status_penerima'])) {
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->dropColumn(['nama_penerima', 'id_penerima', 'status_penerima']);
            });
        }
    }
}
