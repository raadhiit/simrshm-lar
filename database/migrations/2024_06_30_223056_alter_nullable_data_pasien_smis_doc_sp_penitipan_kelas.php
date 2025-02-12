<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterNullableDataPasienSmisDocSpPenitipanKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        // Alter table smis_doc_surat_pernyataan_penitipan_kelas with raw query
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN telp_pasien VARCHAR(255) NULL');
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN alamat_pasien VARCHAR(255) NULL');
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN nama_pasien VARCHAR(255) NULL');

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        // Alter table smis_doc_surat_pernyataan_penitipan_kelas with raw query
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN telp_pasien VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN alamat_pasien VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY COLUMN nama_pasien VARCHAR(255) NOT NULL');

        DB::commit();
    }
}
