<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa;
use App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa2;
use App\Models\Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa3;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SMIS_Rg_Perujuk;
use App\Models\SmisHrdEmployee;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Rad_Pesanan;
use Illuminate\Support\Facades\Auth;

class FormulirAsesmenAwalPasienRawatInapDewasaService
{
    function create($data)
    {
        $temp_data = [
            'tgl_kedatangan' => $data->tgl_kedatangan ? $data->tgl_kedatangan : '',
            'jam_kedatangan' => $data->jam_kedatangan ? $data->jam_kedatangan : '',
            'tgl_pengkajian' => $data->tgl_pengkajian ? $data->tgl_pengkajian : '',
            'jam_pengkajian' => $data->jam_pengkajian ? $data->jam_pengkajian : '',
            'diperoleh_dari' => $data->diperoleh_dari ? $data->diperoleh_dari : '',
            'hubungan_dengan_pasien' => $data->hubungan_dengan_pasien ? $data->hubungan_dengan_pasien : '',
            'cara_masuk' => $data->radio_cara_masuk ? $data->radio_cara_masuk : '',
            'asal_pasien' => $data->radio_asal_pasien ? $data->radio_asal_pasien : '',
            'nama_primary_nurse' => $data->nama_primary_nurse ? $data->nama_primary_nurse : '',
            'keluhan_utama' => $data->keluhan_utama ? $data->keluhan_utama : '',
            'riwayat_penyakit_sekarang' => $data->riwayat_penyakit_sekarang ? $data->riwayat_penyakit_sekarang : '',
            'riwayat_penyakit_dahulu' => $data->riwayat_penyakit_dahulu ? $data->riwayat_penyakit_dahulu : '',
            'riwayat_penyakit_keluarga' => $data->radio_riwayat_penyakit_keluarga ? $data->radio_riwayat_penyakit_keluarga : '',
            'ket_riwayat_penyakit_keluarga' => $data->ket_riwayat_penyakit_keluarga ? $data->ket_riwayat_penyakit_keluarga : '',
            'riwayat_penggunaan_obat' => $data->riwayat_penggunaan_obat ? $data->riwayat_penggunaan_obat : '',
            'ket_riwayat_penggunaan_obat' => $data->ket_riwayat_penggunaan_obat ? $data->ket_riwayat_penggunaan_obat : '',
            'riwayat_alergi' => $data->radio_riwayat_alergi ? $data->radio_riwayat_alergi : '',
            'ket_riwayat_alergi' => $data->ket_riwayat_alergi ? $data->ket_riwayat_alergi : '',
            'keadaan_umum' => $data->radio_keadaan_umum ? $data->radio_keadaan_umum : '',
            'kesadaran' => $data->radio_kesadaran ? $data->radio_kesadaran : '',
            'e_kesadaran' => $data->e_kesadaran ? $data->e_kesadaran : '',
            'm_kesadaran' => $data->m_kesadaran ? $data->m_kesadaran : '',
            'v_kesadaran' => $data->v_kesadaran ? $data->v_kesadaran : '',
            'status_generalis' => $data->status_generalis ? $data->status_generalis : '',
            'jam_tindakan1' => $data->jam_tindakan1 ? $data->jam_tindakan1 : '',
            'tindakan1' => $data->tindakan1 ? $data->tindakan1 : '',
            'diberikan_oleh1' => $data->diberikan_oleh1 ? $data->diberikan_oleh1 : '',
            'keterangan1' => $data->keterangan1 ? $data->keterangan1 : '',
            'jam_tindakan2' => $data->jam_tindakan2 ? $data->jam_tindakan2 : '',
            'tindakan2' => $data->tindakan2 ? $data->tindakan2 : '',
            'diberikan_oleh2' => $data->diberikan_oleh2 ? $data->diberikan_oleh2 : '',
            'keterangan2' => $data->keterangan2 ? $data->keterangan2 : '',
            'jam_tindakan3' => $data->jam_tindakan3 ? $data->jam_tindakan3 : '',
            'tindakan3' => $data->tindakan3 ? $data->tindakan3 : '',
            'diberikan_oleh3' => $data->diberikan_oleh3 ? $data->diberikan_oleh3 : '',
            'keterangan3' => $data->keterangan3 ? $data->keterangan3 : '',
            'jam_tindakan4' => $data->jam_tindakan4 ? $data->jam_tindakan4 : '',
            'tindakan4' => $data->tindakan4 ? $data->tindakan4 : '',
            'diberikan_oleh4' => $data->diberikan_oleh4 ? $data->diberikan_oleh4 : '',
            'keterangan4' => $data->keterangan4 ? $data->keterangan4 : '',
            'jam_tindakan5' => $data->jam_tindakan5 ? $data->jam_tindakan5 : '',
            'tindakan5' => $data->tindakan5 ? $data->tindakan5 : '',
            'diberikan_oleh5' => $data->diberikan_oleh5 ? $data->diberikan_oleh5 : '',
            'keterangan5' => $data->keterangan5 ? $data->keterangan5 : '',
            'jam_tindakan6' => $data->jam_tindakan6 ? $data->jam_tindakan6 : '',
            'tindakan6' => $data->tindakan6 ? $data->tindakan6 : '',
            'diberikan_oleh6' => $data->diberikan_oleh6 ? $data->diberikan_oleh6 : '',
            'keterangan6' => $data->keterangan6 ? $data->keterangan6 : '',
            'td' => $data->td ? $data->td : '',
            'rr' => $data->rr ? $data->rr : '',
            'nadi' => $data->nadi ? $data->nadi : '',
            'suhu' => $data->suhu ? $data->suhu : '',
        ];

        if (isset($data->nama_obat) && count($data->nama_obat) > 0) {
            $temp_riwayat_obat = [];
            for ($i=0; $i < count($data->nama_obat); $i++) { 
                $val = [];
                $val['nama_obat'] = $data->nama_obat[$i];
                $val['dosis'] = $data->dosis[$i];
                $val['cara_pemberian'] = $data->cara_pemberian[$i];
                $val['frekuensi'] = $data->frekuensi[$i];
                $val['waktu_pemberian'] = $data->waktu_pemberian[$i];

                array_push($temp_riwayat_obat, $val);
            }

            $temp_data['list_riwayat_penggunaan_obat'] = json_encode($temp_riwayat_obat);
        }

        $tes = Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], $temp_data);

        return $tes;
    }

    function create2($data)
    {
        $anamnesis = [];
        $anamnesis['riwayat_penyakit_keluarga'] = $data->radio_riwayat_penyakit_keluarga_p;
        $anamnesis['riwayat_penggunaan_obat'] = $data->radio_riwayat_penggunaan_obat_p;
        $anamnesis['riwayat_alergi'] = $data->radio_riwayat_alergi_p;
        $anamnesis['riwayat_transfusi'] = $data->radio_riwayat_transfusi;
        $anamnesis['riwayat_timbul_reaksi'] = $data->radio_riwayat_timbul_reaksi;
        $anamnesis['riwayat_kemoterapi'] = $data->radio_riwayat_kemoterapi;
        $anamnesis['riwayat_radioterapi'] = $data->radio_riwayat_radioterapi;
        $anamnesis['golongan_darah'] = $data->radio_golongan_darah;
        $anamnesis['rh'] = $data->radio_rh;
        $anamnesis['keadaan_umum'] = $data->radio_keadaan_umum_p;
        $anamnesis['kesadaran'] = $data->radio_kesadaran_p;

        $persistem = [];
        $persistem['kesadaran_persistem'] = $data->radio_kesadaran_persistem;
        $persistem['kepala'] = $data->radio_kepala;
        $persistem['ubun_ubun'] = $data->radio_ubun_ubun;
        $persistem['wajah'] = $data->radio_wajah;
        $persistem['leher'] = $data->radio_leher;
        $persistem['kejang'] = $data->radio_kejang;
        $persistem['sensorik'] = $data->radio_sensorik;
        $persistem['motorik'] = $data->radio_motorik;
        $persistem['kekuatan_otot'] = $data->radio_kekuatan_otot;
        $persistem['posisi_mata'] = $data->radio_posisi_mata;
        $persistem['pupil'] = $data->radio_pupil;
        $persistem['kelopak_mata'] = $data->radio_kelopak_mata;
        $persistem['konjungtiva'] = $data->radio_konjungtiva;
        $persistem['seklera'] = $data->radio_seklera;
        $persistem['alat_bantu_penglihatan'] = $data->radio_alat_bantu_penglihatan;
        $persistem['detail_alat_bantu_penglihatan'] = $data->radio_detail_alat_bantu_penglihatan;
        $persistem['sistem_pendengaran'] = $data->radio_sistem_pendengaran;
        $persistem['alat_bantu_pendengaran'] = $data->radio_alat_bantu_pendengaran;
        $persistem['sistem_penciuman'] = $data->radio_sistem_penciuman;
        $persistem['pola_napas'] = $data->radio_pola_napas;
        $persistem['volume_pernapasan'] = $data->radio_volume_pernapasan;
        $persistem['jenis_pernapasan'] = $data->radio_jenis_pernapasan;
        $persistem['irama_napas'] = $data->radio_irama_napas;
        $persistem['kesulitan_bernapas'] = $data->radio_kesulitan_bernapas;
        $persistem['detail_kesulitan_bernapas'] = $data->radio_detail_kesulitan_bernapas;
        $persistem['batuk'] = $data->radio_batuk;
        $persistem['detail_batuk'] = $data->radio_detail_batuk;
        $persistem['warna_kulit'] = $data->radio_warna_kulit;
        $persistem['nyeri_dada'] = $data->radio_nyeri_dada;
        $persistem['denyut_nadi'] = $data->radio_denyut_nadi;
        $persistem['sirkulasi'] = $data->radio_sirkulasi;
        $persistem['pulsasi'] = $data->radio_pulsasi;
        $persistem['mulut'] = $data->radio_mulut;
        $persistem['gigi'] = $data->radio_gigi;
        $persistem['lidah'] = $data->radio_lidah;
        $persistem['tenggorokan'] = $data->radio_tenggorokan;
        $persistem['leher'] = $data->radio_leher;
        $persistem['abdomen'] = $data->radio_abdomen;
        $persistem['apus'] = $data->radio_apus;
        $persistem['bab'] = $data->radio_bab;
        $persistem['kebersihan'] = $data->radio_kebersihan;
        $persistem['kelainan'] = $data->radio_kelainan;
        $persistem['bak'] = $data->radio_bak;
        $persistem['gangguan_haid'] = $data->radio_gangguan_haid;
        $persistem['alat_kontrasepsi'] = $data->radio_alat_kontrasepsi;
        $persistem['payudara'] = $data->radio_payudara;
        $persistem['puting'] = $data->radio_puting;
        $persistem['mastitis'] = $data->radio_mastitis;
        $persistem['kontraksi_uterus'] = $data->radio_kontraksi_uterus;
        $persistem['sirkumsisi'] = $data->radio_sirkumsisi;
        $persistem['gangguan_prostat'] = $data->radio_gangguan_prostat;
        $persistem['turgo'] = $data->radio_turgo;
        $persistem['warna_integumen'] = $data->radio_warna_integumen;
        $persistem['integritas'] = $data->radio_integritas;
        $persistem['dekubituas'] = $data->radio_dekubituas;
        $persistem['pergerakan_sendi'] = $data->radio_pergerakan_sendi;
        $persistem['kekuatan_otot'] = $data->radio_kekuatan_otot;
        $persistem['nyeri_sendi'] = $data->radio_nyeri_sendi;
        $persistem['oedema'] = $data->radio_oedema;
        $persistem['fraktur'] = $data->radio_fraktur;
        $persistem['parese'] = $data->radio_parese;

        $kualifikasi_nyeri = [];
        $kualifikasi_nyeri['nyeri'] = $data->radio_nyeri;
        $kualifikasi_nyeri['sifat_nyeri'] = $data->radio_sifat_nyeri;
        $kualifikasi_nyeri['kualitas_nyeri'] = $data->radio_kualitas_nyeri;
        $kualifikasi_nyeri['menjalar'] = $data->radio_menjalar;
        $kualifikasi_nyeri['frekuensi_nyeri'] = $data->radio_frekuensi_nyeri;
        $kualifikasi_nyeri['pengaruh_nyeri'] = $data->radio_pengaruh_nyeri;

        $pola_kehidupan = [];
        $pola_kehidupan['aktifitas_makan_sebelum_sakit'] = $data->radio_aktifitas_makan_sebelum_sakit;
        $pola_kehidupan['aktifitas_mandi_sebelum_sakit'] = $data->radio_aktifitas_mandi_sebelum_sakit;
        $pola_kehidupan['aktifitas_eliminasi_sebelum_sakit'] = $data->radio_aktifitas_eliminasi_sebelum_sakit;
        $pola_kehidupan['aktifitas_berpakaian_sebelum_sakit'] = $data->radio_aktifitas_berpakaian_sebelum_sakit;
        $pola_kehidupan['aktifitas_berpindah_sebelum_sakit'] = $data->radio_aktifitas_berpindah_sebelum_sakit;
        $pola_kehidupan['pola_tidur_sebelum_sakit'] = $data->radio_pola_tidur_sebelum_sakit;
        $pola_kehidupan['riwayat_merokok_sebelum_sakit'] = $data->radio_riwayat_merokok_sebelum_sakit;
        $pola_kehidupan['riwayat_miras_sebelum_sakit'] = $data->radio_riwayat_miras_sebelum_sakit;
        $pola_kehidupan['riwayat_obat_penenang_sebelum_sakit'] = $data->radio_riwayat_obat_penenang_sebelum_sakit;
        $pola_kehidupan['aktifitas_makan_saat_sakit'] = $data->radio_aktifitas_makan_saat_sakit;
        $pola_kehidupan['aktifitas_mandi_saat_sakit'] = $data->radio_aktifitas_mandi_saat_sakit;
        $pola_kehidupan['aktifitas_eliminasi_saat_sakit'] = $data->radio_aktifitas_eliminasi_saat_sakit;
        $pola_kehidupan['aktifitas_berpakaian_saat_sakit'] = $data->radio_aktifitas_berpakaian_saat_sakit;
        $pola_kehidupan['aktifitas_berpindah_saat_sakit'] = $data->radio_aktifitas_berpindah_saat_sakit;
        $pola_kehidupan['pola_tidur_saat_sakit'] = $data->radio_pola_tidur_saat_sakit;
        $pola_kehidupan['lama_tidur_saat_sakit'] = $data->lama_tidur_saat_sakit;

        $tes = Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa2::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'tgl_pengkajian_keperawatan' => $data->tgl_pengkajian_keperawatan,
            'jam_pengkajian_keperawatan' => $data->jam_pengkajian_keperawatan,
            'diperoleh_dari' => $data->diperoleh_dari,
            'keluhan_utama' => $data->keluhan_utama,
            'riwayat_penyakit_sekarang' => $data->riwayat_penyakit_sekarang,
            'riwayat_penyakit_dahulu' => $data->riwayat_penyakit_dahulu,
            'anamnesis' => json_encode($anamnesis),
            'ket_riwayat_penyakit_keluarga' => $data->ket_riwayat_penyakit_keluarga,
            'riwayat_penggunaan_obat' => $data->riwayat_penggunaan_obat,
            'ket_riwayat_penggunaan_obat' => $data->ket_riwayat_penggunaan_obat,
            'riwayat_alergi' => $data->riwayat_alergi,
            'ket_riwayat_alergi' => $data->ket_riwayat_alergi,
            'riwayat_transfusi' => $data->riwayat_transfusi,
            'riwayat_timbul_reaksi' => $data->riwayat_timbul_reaksi,
            'ket_riwayat_transfusi' => $data->ket_riwayat_transfusi,
            'ket_riwayat_timbul_reaksi' => $data->ket_riwayat_timbul_reaksi,
            'riwayat_kemoterapi' => $data->riwayat_kemoterapi,
            'ket_riwayat_kemoterapi' => $data->ket_riwayat_kemoterapi,
            'berapa_kali_riwayat_kemoterapi' => $data->berapa_kali_riwayat_kemoterapi,
            'riwayat_radioterapi' => $data->riwayat_radioterapi,
            'ket_riwayat_radioterapi' => $data->ket_riwayat_radioterapi,
            'berapa_kali_riwayat_radioterapi' => $data->berapa_kali_riwayat_radioterapi,
            'golongan_darah' => $data->golongan_darah,
            'rh' => $data->rh,
            'keadaan_umum' => $data->keadaan_umum,
            'kesadaran' => $data->kesadaran,
            'e_kesadaran' => $data->e_kesadaran,
            'm_kesadaran' => $data->m_kesadaran,
            'v_kesadaran' => $data->v_kesadaran,
            'persistem' => json_encode($persistem),
            'ket_kepala' => $data->ket_kepala,
            'ket_ubun_ubun' => $data->ket_ubun_ubun,
            'ket_wajah' => $data->ket_wajah,
            'ket_leher' => $data->ket_leher,
            'ket_kejang' => $data->ket_kejang,
            'ket_kelopak_mata' => $data->ket_kelopak_mata,
            'ket_konjungtiva' => $data->ket_konjungtiva,
            'ket_seklera' => $data->ket_seklera,
            'ket_sistem_pendengaran' => $data->ket_sistem_pendengaran,
            'ket_sistem_penciuman' => $data->ket_sistem_penciuman,
            'ket_jenis_pernapasan' => $data->ket_jenis_pernapasan,
            'detail_kesulitan_bernapas' => $data->detail_kesulitan_bernapas,
            'ket_detail_kesulitan_bernapas' => $data->ket_detail_kesulitan_bernapas,
            'detail_batuk' => $data->detail_batuk,
            'ket_warna_kulit' => $data->ket_warna_kulit,
            'ket_nyeri_dada' => $data->ket_nyeri_dada,
            'ket_sirkulasi' => $data->ket_sirkulasi,
            'ket_pulsasi' => $data->ket_pulsasi,
            'ket_mulut' => $data->ket_mulut,
            'ket_gigi' => $data->ket_gigi,
            'ket_lidah' => $data->ket_lidah,
            'ket_apus' => $data->ket_apus,
            'ket_kebersihan' => $data->ket_kebersihan,
            'ket_kelainan' => $data->ket_kelainan,
            'ket_bak' => $data->ket_bak,
            'umur_menarche' => $data->umur_menarche,
            'siklus_haid_menarche' => $data->siklus_haid_menarche,
            'lama_haid_menarche' => $data->lama_haid_menarche,
            'hpht_menarche' => $data->hpht_menarche,
            'ket_gangguan_haid' => $data->ket_gangguan_haid,
            'ket_alat_kontrasepsi' => $data->ket_alat_kontrasepsi,
            'tfu' => $data->tfu,
            'ket_dekubituas' => $data->ket_dekubituas,
            'ket_nyeri_sendi' => $data->ket_nyeri_sendi,
            'ket_oedema' => $data->ket_oedema,
            'ket_fraktur' => $data->ket_fraktur,
            'ket_parese' => $data->ket_parese,

            'kualifikasi_nyeri' => json_encode($kualifikasi_nyeri),
            'ket_nyeri_menjalar' => $data->ket_nyeri_menjalar,
            'skor_nyeri' => $data->skor_nyeri,
            'pola_kehidupan' => json_encode($pola_kehidupan),

            'pola_nutrisi_sebelum_sakit' => $data->pola_nutrisi_sebelum_sakit ? json_encode($data->pola_nutrisi_sebelum_sakit) : '[]',
            'frekuensi_makan_sebelum_sakit' => $data->frekuensi_makan_sebelum_sakit,
            'jenis_makan_sebelum_sakit' => $data->jenis_makan_sebelum_sakit,
            'porsi_makan_sebelum_sakit' => $data->porsi_makan_sebelum_sakit,
            'lama_tidur_sebelum_sakit' => $data->lama_tidur_sebelum_sakit,
            'bak_sebelum_sakit' => $data->bak_sebelum_sakit ? json_encode($data->bak_sebelum_sakit) : '[]',
            'kelinan_bak_sebelum_sakit' => $data->kelinan_bak_sebelum_sakit,
            'warna_bak_sebelum_sakit' => $data->warna_bak_sebelum_sakit,
            'bab_sebelum_sakit' => $data->bab_sebelum_sakit ? json_encode($data->bab_sebelum_sakit) : '[]',
            'kelinan_bab_sebelum_sakit' => $data->kelinan_bab_sebelum_sakit,
            'warna_bab_sebelum_sakit' => $data->warna_bab_sebelum_sakit,
            'konsistensi_bab_sebelum_sakit' => $data->konsistensi_bab_sebelum_sakit,
            'konstipasi_bab_sebelum_sakit' => $data->konstipasi_bab_sebelum_sakit,
            'ket_bab_sebelum_sakit' => $data->ket_bab_sebelum_sakit,

            'pola_nutrisi_saat_sakit' => $data->pola_nutrisi_saat_sakit ? json_encode($data->pola_nutrisi_saat_sakit) : '[]',
            'frekuensi_makan_saat_sakit' => $data->frekuensi_makan_saat_sakit,
            'jenis_makan_saat_sakit' => $data->jenis_makan_saat_sakit,
            'porsi_makan_saat_sakit' => $data->porsi_makan_saat_sakit,
            'bak_saat_sakit' => $data->bak_saat_sakit ? json_encode($data->bak_saat_sakit) : '[]',
            'kelinan_bak_saat_sakit' => $data->kelinan_bak_saat_sakit,
            'warna_bak_saat_sakit' => $data->warna_bak_saat_sakit,
            'bab_saat_sakit' => $data->bab_saat_sakit ? json_encode($data->bab_saat_sakit) : '[]',
            'kelinan_bab_saat_sakit' => $data->kelinan_bab_saat_sakit,
            'warna_bab_saat_sakit' => $data->warna_bab_saat_sakit,
            'konsistensi_bab_saat_sakit' => $data->konsistensi_bab_saat_sakit,
            'konstipasi_bab_saat_sakit' => $data->konstipasi_bab_saat_sakit,
            'ket_bab_saat_sakit' => $data->ket_bab_saat_sakit,

            'jumlah_riwayat_merokok_sebelum_sakit' => $data->jumlah_riwayat_merokok_sebelum_sakit,
            'lamanya_riwayat_merokok_sebelum_sakit' => $data->lamanya_riwayat_merokok_sebelum_sakit,
            'jenis_riwayat_miras_sebelum_sakit' => $data->jenis_riwayat_miras_sebelum_sakit,
            'jumlah_riwayat_miras_sebelum_sakit' => $data->jumlah_riwayat_miras_sebelum_sakit,
            'jenis_riwayat_obat_penenang_sebelum_sakit' => $data->jenis_riwayat_obat_penenang_sebelum_sakit,
            'jumlah_riwayat_obat_penenang_sebelum_sakit' => $data->jumlah_riwayat_obat_penenang_sebelum_sakit,
        ]);

        $spiritual = [];
        $spiritual['agama'] = $data->radio_agama ? $data->radio_agama : '';
        $spiritual['keprihatinan'] = $data->radio_keprihatinan ? $data->radio_keprihatinan : '';
        $spiritual['pekerjaan'] = $data->radio_pekerjaan ? $data->radio_pekerjaan : '';
        $spiritual['tinggal_bersama'] = $data->radio_tinggal_bersama ? $data->radio_tinggal_bersama : '';
        $spiritual['pendidikan_pasien'] = $data->radio_pendidikan_pasien ? $data->radio_pendidikan_pasien : '';
        $spiritual['pendidikan_pj'] = $data->radio_pendidikan_pj ? $data->radio_pendidikan_pj : '';

        $proteksi = [];
        $proteksi['status_mental'] = $data->radio_status_mental;
        $proteksi['detail_status_mental'] = $data->radio_detail_status_mental;
        $proteksi['status_psikologis'] = $data->radio_status_psikologis;
        $proteksi['penggunaan_restrain'] = $data->radio_penggunaan_restrain;
        $proteksi['detail_penggunaan_restrain'] = $data->radio_detail_penggunaan_restrain;
        $proteksi['pengkajian_resiko_jatuh'] = $data->radio_pengkajian_resiko_jatuh;
        $skor = [];
        $skor['riwayat_jatuh'] = $data->riwayat_jatuh ? $data->riwayat_jatuh : '';
        $skor['diagnosis_sekunder'] = $data->diagnosis_sekunder ? $data->diagnosis_sekunder : '';
        $skor['ambulasi'] = $data->ambulasi ? $data->ambulasi : '';
        $skor['heparin_lock'] = $data->heparin_lock ? $data->heparin_lock : '';
        $skor['gaya_berjalan'] = $data->gaya_berjalan ? $data->gaya_berjalan : '';
        $skor['status_mental'] = $data->status_mental ? $data->status_mental : '';

        $pengkajian_fungsi = [];
        $pengkajian_fungsi['kemampuan_aktifitas'] = $data->radio_kemampuan_aktifitas ? $data->radio_kemampuan_aktifitas : '';
        $pengkajian_fungsi['aktivitas'] = $data->radio_aktivitas ? $data->radio_aktivitas : '';
        $pengkajian_fungsi['berjalan'] = $data->radio_berjalan ? $data->radio_berjalan : '';
        $pengkajian_fungsi['alat_ambulasi'] = $data->radio_alat_ambulasi ? $data->radio_alat_ambulasi : '';
        $pengkajian_fungsi['ekstremitas_atas'] = $data->radio_ekstremitas_atas ? $data->radio_ekstremitas_atas : '';
        $pengkajian_fungsi['ekstremitas_bawah'] = $data->radio_ekstremitas_bawah ? $data->radio_ekstremitas_bawah : '';
        $pengkajian_fungsi['kemampuan_menggenggam'] = $data->radio_kemampuan_menggenggam ? $data->radio_kemampuan_menggenggam : '';
        $pengkajian_fungsi['kemampuan_koordinasi'] = $data->radio_kemampuan_koordinasi ? $data->radio_kemampuan_koordinasi : '';
        $pengkajian_fungsi['kemampuan_gangguan_fungsi'] = $data->radio_kemampuan_gangguan_fungsi ? $data->radio_kemampuan_gangguan_fungsi : '';

        $kebutuhan_komunikasi = [];
        $kebutuhan_komunikasi['pendidikan_bicara'] = $data->radio_pendidikan_bicara ? $data->radio_pendidikan_bicara : '';
        $kebutuhan_komunikasi['pendidikan_bahasa'] = $data->radio_pendidikan_bahasa ? $data->radio_pendidikan_bahasa : '';
        $kebutuhan_komunikasi['penerjemah'] = $data->radio_penerjemah ? $data->radio_penerjemah : '';
        $kebutuhan_komunikasi['bahasa_isyarat'] = $data->radio_bahasa_isyarat ? $data->radio_bahasa_isyarat : '';
        $kebutuhan_komunikasi['hambatan_belajar'] = $data->radio_hambatan_belajar ? $data->radio_hambatan_belajar : '';
        $kebutuhan_komunikasi['detail_hambatan_belajar'] = $data->radio_detail_hambatan_belajar ? $data->radio_detail_hambatan_belajar : '';
        $kebutuhan_komunikasi['cara_belajar'] = $data->radio_cara_belajar ? $data->radio_cara_belajar : '';
        $kebutuhan_komunikasi['informasi_tentang'] = $data->radio_informasi_tentang ? $data->radio_informasi_tentang : '';

        $skrining_gizi_perawat = [];
        $skrining_gizi_perawat['penurunan_nafsu_makan'] = $data->radio_penurunan_nafsu_makan ? $data->radio_penurunan_nafsu_makan : '';
        $skrining_gizi_perawat['penurunan_bb'] = $data->radio_penurunan_bb ? $data->radio_penurunan_bb : '';
        $skrining_gizi_perawat['diet_diberikan'] = $data->diet_diberikan ? $data->diet_diberikan : '';
        $skrining_gizi_perawat['lebih_dari_dua'] = $data->lebih_dari_dua ? $data->lebih_dari_dua : '';
        $skrining_gizi_perawat['diet_nutrisi'] = $data->radio_diet_nutrisi ? $data->radio_diet_nutrisi : '';
        $skrining_gizi_perawat['rehab_medik'] = $data->radio_rehab_medik ? $data->radio_rehab_medik : '';
        $skrining_gizi_perawat['farmasi'] = $data->radio_farmasi ? $data->radio_farmasi : '';
        $skrining_gizi_perawat['perawatan_luka'] = $data->radio_perawatan_luka ? $data->radio_perawatan_luka : '';
        $skrining_gizi_perawat['manajemen_nyeri'] = $data->radio_manajemen_nyeri ? $data->radio_manajemen_nyeri : '';

        $tes2 = Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa3::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'spiritual' => json_encode($spiritual),
            'agama_lain' => $data->agama_lain,
            'checkbox_spiritual' => $data->checkbox_spiritual ? json_encode($data->checkbox_spiritual) : '[]',
            'ket_keprihatinan_detail' => $data->ket_keprihatinan_detail,
            'pekerjaan_lain' => $data->pekerjaan_lain,
            'tinggal_bersama_lain' => $data->tinggal_bersama_lain,
            'pendidikan_pasien_lain' => $data->pendidikan_pasien_lain,
            'pendidikan_pj_lain' => $data->pendidikan_pj_lain,
            'suku' => $data->suku,
            'proteksi' => json_encode($proteksi),
            'ket_status_psikologis' => $data->ket_status_psikologis,
            'skor' => json_encode($skor),
            'total_skor' => $data->total_skor,

            'pengkajian_fungsi' => json_encode($pengkajian_fungsi),
            'ket_patah_tulang' => $data->ket_patah_tulang ? $data->ket_patah_tulang : '',
            'ket_berjalan' => $data->ket_berjalan ? $data->ket_berjalan : '',
            'ket_edema' => $data->ket_edema ? $data->ket_edema : '',
            'ket_ekstremitas_bawah' => $data->ket_ekstremitas_bawah ? $data->ket_ekstremitas_bawah : '',
            'ket_kemampuan_menggenggam' => $data->ket_kemampuan_menggenggam ? $data->ket_kemampuan_menggenggam : '',
            'ket_kemampuan_koordinasi' => $data->ket_kemampuan_koordinasi ? $data->ket_kemampuan_koordinasi : '',

            'kebutuhan_komunikasi' => json_encode($kebutuhan_komunikasi),
            'ket_gangguan_bicara' => $data->ket_gangguan_bicara ? $data->ket_gangguan_bicara : '',
            'ket_bahasa_daerah' => $data->ket_bahasa_daerah ? $data->ket_bahasa_daerah : '',
            'ket_pendidikan_bahasa' => $data->ket_pendidikan_bahasa ? $data->ket_pendidikan_bahasa : '',
            'ket_bahasa_penerjemah' => $data->ket_bahasa_penerjemah ? $data->ket_bahasa_penerjemah : '',
            'ket_detail_hambatan_belajar' => $data->ket_detail_hambatan_belajar ? $data->ket_detail_hambatan_belajar : '',
            'ket_informasi_tentang' => $data->ket_informasi_tentang ? $data->ket_informasi_tentang : '',

            'kebutuhan_privasi_pasien' => $data->kebutuhan_privasi_pasien ? json_encode($data->kebutuhan_privasi_pasien) : '[]',
            'ket_tempat_khusus' => $data->ket_tempat_khusus ? $data->ket_tempat_khusus : '',
            'ket_privasi_lain_lain' => $data->ket_privasi_lain_lain ? $data->ket_privasi_lain_lain : '',

            'skrining_gizi_perawat' => json_encode($skrining_gizi_perawat),
            'kelainan_pasien' => $data->kelainan_pasien ? json_encode($data->kelainan_pasien) : '[]',
            'masalah_keperawatan' => $data->masalah_keperawatan ? json_encode($data->masalah_keperawatan) : '[]',
            'ket_masalah_keperawatan' => $data->ket_masalah_keperawatan ? $data->ket_masalah_keperawatan : '',
            'rencana_keperawatan_satu' => $data->rencana_keperawatan_satu ? $data->rencana_keperawatan_satu : '',
            'rencana_keperawatan_dua' => $data->rencana_keperawatan_dua ? $data->rencana_keperawatan_dua : '',
            'rencana_keperawatan_tiga' => $data->rencana_keperawatan_tiga ? $data->rencana_keperawatan_tiga : '',
            'rencana_keperawatan_empat' => $data->rencana_keperawatan_empat ? $data->rencana_keperawatan_empat : '',
            'rencana_keperawatan_lima' => $data->rencana_keperawatan_lima ? $data->rencana_keperawatan_lima : '',
            'rencana_keperawatan_enam' => $data->rencana_keperawatan_enam ? $data->rencana_keperawatan_enam : '',
            'rencana_keperawatan_tujuh' => $data->rencana_keperawatan_tujuh ? $data->rencana_keperawatan_tujuh : '',
            'ket_diet_nutrisi' => $data->ket_diet_nutrisi ? $data->ket_diet_nutrisi : '',
            'ket_rehab_medik' => $data->ket_rehab_medik ? $data->ket_rehab_medik : '',
            'ket_farmasi' => $data->ket_farmasi ? $data->ket_farmasi : '',
            'ket_perawatan_luka' => $data->ket_perawatan_luka ? $data->ket_perawatan_luka : '',
            'ket_manajemen_nyeri' => $data->ket_manajemen_nyeri ? $data->ket_manajemen_nyeri : '',
            'perencanaan_perawatan_lain_lain' => $data->perencanaan_perawatan_lain_lain ? $data->perencanaan_perawatan_lain_lain : '',

            'info_perencanaan_pulang' => $data->radio_info_perencanaan_pulang ? $data->radio_info_perencanaan_pulang : '',
            'kondisi_pulang' => $data->kondisi_pulang ? $data->kondisi_pulang : '',
            'lama_perawatan' => $data->lama_perawatan ? $data->lama_perawatan : '',
            'tgl_rencana_pulang' => $data->tgl_rencana_pulang ? $data->tgl_rencana_pulang : '',
            'perawatan_lanjutan' => $data->perawatan_lanjutan ? json_encode($data->perawatan_lanjutan) : '[]',
            'ket_perencanaan_pulang' => $data->ket_perencanaan_pulang ? $data->ket_perencanaan_pulang : '',
            'transportasi_pulang' => $data->transportasi_pulang ? json_encode($data->transportasi_pulang) : '[]',
            'transportasi_digunakan_pulang' => $data->transportasi_digunakan_pulang ? json_encode($data->transportasi_digunakan_pulang) : '[]',
            'barang_milik_pasien' => $data->barang_milik_pasien ? json_encode($data->barang_milik_pasien) : '[]',
            'ket_barang_tidak_lengkap' => $data->ket_barang_tidak_lengkap ? $data->ket_barang_tidak_lengkap : '',
            'jam_pengkajian' => $data->jam_pengkajian ? $data->jam_pengkajian : '',
            'tgl_pengkajian' => $data->tgl_pengkajian ? $data->tgl_pengkajian : '',

            'td' => $data->td ? $data->td : '',
            'rr' => $data->rr ? $data->rr : '',
            'nadi' => $data->nadi ? $data->nadi : '',
            'suhu' => $data->suhu ? $data->suhu : '',
            'bb' => $data->bb ? $data->bb : '',
            'tb' => $data->tb ? $data->tb : '',
            'lingkar_kepala' => $data->lingkar_kepala ? $data->lingkar_kepala : '',
            'lingkar_dada' => $data->lingkar_dada ? $data->lingkar_dada : '',
            'lingkar_perut' => $data->lingkar_perut ? $data->lingkar_perut : '',

            'alkohol' => $data->alkohol ? $data->alkohol : '',
            'anti_kejang' => $data->anti_kejang ? $data->anti_kejang : '',
            'narkotik' => $data->narkotik ? $data->narkotik : '',
            'psikotropik' => $data->psikotropik ? $data->psikotropik : '',

            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
        ]);

        return $tes;
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('formulir_asesmen_awal_pasien_ranap_dewasa.resep.detail', 'formulir_asesmen_awal_pasien_ranap_dewasa2',
            'formulir_asesmen_awal_pasien_ranap_dewasa3')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        if($data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa3) {
            $data['employee2'] = SmisHrdEmployee::where('nama', $data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa3->nama_verifikator)->first();
        }
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = SmisHrdEmployee::where('nama', $data['dokumen']->petugas_penyerahan)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan', 'smis_rg_layananpasien.tanggal', 'smis_rg_layananpasien.nama_perusahaan',
                'smis_rg_asuransi.nama as asuransi', 'smis_rg_layananpasien.last_bed', 'smis_rg_layananpasien.uri')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-kelas')->first();
        $data['kelas'] = SmisAdmSettings::where('name', 'smis-rs-kelas-' . $layanan->last_ruangan)->first();

        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', ($data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa ? $data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', ($data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa ? $data['dokumen']->formulir_asesmen_awal_pasien_ranap_dewasa->id_pesanan_rad : 0))->where('prop', '')->first();

        if ($layanan->diagnosa) {
            if ($layanan->diagnosa->diagnosa_sekunder1) {
                $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder1)->first();
            }else{
                $data['kode_sekunder1'] = null;
            }
            if ($layanan->diagnosa->diagnosa_sekunder2) {
                $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder2)->first();
            }else{
                $data['kode_sekunder2'] = null;
            }
            if ($layanan->diagnosa->diagnosa_sekunder3) {
                $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder3)->first();
            }else{
                $data['kode_sekunder3'] = null;
            }
            if ($layanan->diagnosa->diagnosa_sekunder4) {
                $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder4)->first();
            }else{
                $data['kode_sekunder4'] = null;
            }
            if ($layanan->diagnosa->diagnosa_sekunder5) {
                $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder5)->first();
            }else{
                $data['kode_sekunder5'] = null;
            }
            if ($layanan->diagnosa->diagnosa_pra_bedah) {
                $data['kode_diagnosa_pra_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pra_bedah)->first();
            }else{
                $data['kode_diagnosa_pra_bedah'] = null;
            }
            if ($layanan->diagnosa->diagnosa_pasca_bedah) {
                $data['kode_diagnosa_pasca_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pasca_bedah)->first();
            }else{
                $data['kode_diagnosa_pasca_bedah'] = null;
            }
        }

        $data['layanan'] = $layanan;
        
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->get();
        $data['perujuk'] = SMIS_Rg_Perujuk::all();
        $data['dokter'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id','smis_hrd_employee.nama','smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', 'dokter')->get();
        $data['data_employee'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id','smis_hrd_employee.nama','smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', '!=', 'dokter')->get();
        $data['klinik'] = SmisAdmPrototype::where('prop', '!=', 'del')
            ->where('nama', 'LIKE', '%poli%')
            ->where('status', 'actived')
            ->get();
        return $data;
    }

    function save_gambar_lokasi_pengkajian_awal_medis($req)
    {
        $folderPath = public_path('status_lokalis/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = Smis_Doc_Formulir_Asesmen_Awal_Pasien_Ranap_Dewasa::where('id_dokumen', $req->dokumen)->update([
            'gambar_status_lokalis' => $fileName
        ]);

        return $query;
    }
}
