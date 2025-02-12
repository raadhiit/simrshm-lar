<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKunjungan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'dokumen_kunjungan_pasien';

    function rm_pasien()
    {
        return $this->belongsTo('App\Models\Patient', 'nrm');
    }

    function pelayanan()
    {
        return $this->belongsTo('App\Models\SMIS_LayananPasien', 'noreg');
    }

    function verifikator()
    {
        return $this->belongsTo('App\Models\User', 'id_verifikator');
    }

    function general_consent()
    {
        return $this->hasOne('App\Models\Smis_Doc_General_Consent', 'id_dokumen');
    }

    function catatan_edukasi_pasien()
    {
        return $this->hasOne('App\Models\Smis_Doc_Catatan_Edukasi', 'id_dokumen');
    }

    function asesment_medis_awal()
    {
        return $this->hasOne('App\Models\Smis_Doc_Asesment_Medis_Awal', 'id_dokumen');
    }

    function surat_permintaan_rawat_inap()
    {
        return $this->hasOne('App\Models\Smis_Doc_Surat_Permintaan_Rawat_Inap', 'id_dokumen');
    }

    function dokumen_transfer_pasien_internal()
    {
        return $this->hasOne('App\Models\Smis_Doc_Dokumen_Transfer_Pasien_Internal', 'id_dokumen');
    }

    function dokumen_laporan_caesarian()
    {
        return $this->hasOne('App\Models\Smis_Doc_Dokumen_Laporan_Caesarian', 'id_dokumen');
    }

    function dokumen_laporan_anastesi_dan_sedasi()
    {
        return $this->hasOne('App\Models\Smis_Doc_Laporan_Anastesi_Dan_Sedasi', 'id_dokumen');
    }

    function formulir_triage_terintegrasi()
    {
        return $this->hasOne('App\Models\Smis_Doc_Formulir_Triage_Terintegrasi', 'id_dokumen');
    }

    function dokumen_asesment_awal_medis_gawat_darurat()
    {
        return $this->hasOne('App\Models\Smis_Doc_Dokumen_Asesment_Awal_Medis_Gawat_Darurat', 'id_dokumen');
    }

    function dokumen_asesment_awal_keperawatan_igd()
    {
        return $this->hasOne('App\Models\Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd', 'id_dokumen');
    }

    function dokumen_orientasi_pasien_baru()
    {
        return $this->hasOne('App\Models\Smis_Doc_Dokumen_Orientasi_Pasien_Baru', 'id_dokumen');
    }

    function catatan_perkembangan_pasien_terintegrasi()
    {
        return $this->hasOne('App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi', 'id_dokumen');
    }

    function asesmen_awal_kebidanan_ranap()
    {
        return $this->hasOne('App\Models\Smis_Doc_Asesmen_Awal_Kebidanan_Ranap', 'id_dokumen');
    }

    function resume_medis_pasien_pulang()
    {
        return $this->hasOne('App\Models\Smis_Doc_Resume_Medis_Pasien_Pulang', 'id_dokumen');
    }

    function cppt_ranap()
    {
        return $this->hasMany('App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap', 'id_dokumen');
    }

    function formulir_asesmen_awal_pasien_ranap_dewasa()
    {
        return $this->hasOne('App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa', 'id_dokumen');
    }

    function formulir_asesmen_awal_pasien_ranap_dewasa2()
    {
        return $this->hasOne('App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa2', 'id_dokumen');
    }

    function formulir_asesmen_awal_pasien_ranap_dewasa3()
    {
        return $this->hasOne('App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa3', 'id_dokumen');
    }

    function asesmen_awal_pasien_ranap_neonatus()
    {
        return $this->hasOne('App\Models\Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus', 'id_dokumen');
    }

    function asesmen_awal_pasien_ranap_petriadik()
    {
        return $this->hasOne('App\Models\Smis_Doc_Asesmen_Awal_Pasien_Ranap_Petriadik', 'id_dokumen');
    }

    function indikator_sc()
    {
        return $this->hasOne('App\Models\SmisDocIndikatorSc', 'id_dokumen');
    }

    function sp_penitipan_kelas()
    {
        return $this->hasOne('App\Models\SmisDocSuratPernyataanPenitipanKelas', 'id_dokumen');
    }

    function permintaan_pemeriksaan_patologi_anatomi()
    {
        return $this->hasOne('App\Models\SmisDocPermintaanPemeriksaanPatologiAnatomi', 'id_dokumen');
    }

    function sp_pulang_aps()
    {
        return $this->hasOne('App\Models\SmisDocSuratPernyataanPulangAps', 'id_dokumen');
    }

    function penolakan_rawat_inap()
    {
        return $this->hasOne('App\Models\SmisDocPenolakanRawatInap', 'id_dokumen');
    }

    function sp_naik_kelas()
    {
        return $this->hasOne('App\Models\SmisDocSuratPernyataanNaikKelas', 'id_dokumen');
    }

    function surat_keterangan_kematian()
    {
        return $this->hasOne('App\Models\Smis_Doc_Surat_Keterangan_Kematian', 'id_dokumen');
    }
    function informasi_tindakan_anestesi_sedasi()
    {
        return $this->hasOne('App\Models\Smis_Doc_Informasi_Tindakan_Anestesi_Sedasi', 'id_dokumen');
    }
    function persetujuan_transfusi_darah()
    {
        return $this->hasOne('App\Models\Smis_Doc_Persetujuan_Transfusi_Darah', 'id_dokumen');
    }
    function surat_pernyataan_naik_kelas()
    {
        return $this->hasOne('App\Models\Smis_Doc_Surat_Pernyataan_Naik_Kelas', 'id_dokumen');
    }
    function tindakan_anestesi_epidural()
    {
        return $this->hasOne('App\Models\Smis_Doc_Tindakan_Anestesi_Epidural', 'id_dokumen');
    }

    function persetujuan_atau_penolakan_tindakan_kedokteran()
    {
        return $this->hasOne('App\Models\Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran', 'id_dokumen');
    }

    function skala_risiko_jatuh_humpty_dumpty_untuk_pediatri()
    {
        return $this->hasOne('App\Models\Smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatri', 'id_dokumen');
    }

    function formulir_skrining_awal_gizi_anak()
    {
        return $this->hasOne('App\Models\SmisDocFormulirSkriningAwalGiziAnak', 'id_dokumen');
    }

    function formulir_skrining_awal_gizi_dewasa()
    {
        return $this->hasOne('App\Models\Smis_Doc_Formulir_Skrining_Awal_Gizi_Dewasa', 'id_dokumen');
    }

    function formulir_triage_terintegrasi_v2()
    {
        return $this->hasOne('App\Models\FormulirTriageTerintegrasiV2', 'id_dokumen');
    }

    function formulir_layanan_kedokteran_fisik_rehabilitasi()
    {
        return $this->hasOne('App\Models\FormulirLayananKedokteranFisikRehabilitasi', 'id_dokumen');
    }

    function lembar_hasil_tindakan_uji_fungsi()
    {
        return $this->hasOne('App\Models\DokumenKunjungan\Smis_Doc_Lembar_Hasil_Tindakan_Uji_Fungsi', 'id_dokumen');
    }

    function program_pelayanan_fisioterapi()
    {
        return $this->hasOne('App\Models\DokumenKunjungan\Smis_Doc_Program_Pelayanan_Fisioterapi', 'id_dokumen');
    }

    function formulir_klaim_fisioterapi()
    {
        return $this->hasOne('App\Models\DokumenKunjungan\Smis_Doc_Formulir_Klaim_Fisioterapi', 'id_dokumen');
    }

    function rekonsiliasi_obat()
    {
        return $this->hasOne('App\Models\DokumenKunjungan\SmisDocRekonsiliasiObat', 'id_dokumen');
    }
}
