<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdForDaftarTilikAndAssesmenPerioperatif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('smis_doc_daftar_tilik_pasien_operasi', 'id')) {
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->dropPrimary('id');
                $table->renameColumn('id', 'id_dokumen');
            });
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->id()->first();
            });
        }

        if (Schema::hasColumn('smis_doc_assesment_perioperatif_medis', 'id')) {
            Schema::table('smis_doc_assesment_perioperatif_medis', function (Blueprint $table) {
                $table->dropPrimary('id');
                $table->renameColumn('id', 'id_dokumen');
            });
            Schema::table('smis_doc_assesment_perioperatif_medis', function (Blueprint $table) {
                $table->id()->first();
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
        if (Schema::hasColumn('smis_doc_daftar_tilik_pasien_operasi', 'id')) {
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->dropPrimary('id');
            });
            Schema::table('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
                $table->renameColumn('id_dokumen', 'id');
                $table->primary('id');
            });
        }

        if (Schema::hasColumn('smis_doc_assesment_perioperatif_medis', 'id')) {
            Schema::table('smis_doc_assesment_perioperatif_medis', function (Blueprint $table) {
                $table->dropPrimary('id');
            });
            Schema::table('smis_doc_assesment_perioperatif_medis', function (Blueprint $table) {
                $table->renameColumn('id_dokumen', 'id');
                $table->primary('id');
            });
        }
    }
}
