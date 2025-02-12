<?php

namespace App\Services;

use App\Models\Antrian;
use App\Models\JadwalPoli;
use App\Models\SatuSehatLocation;
use App\Models\SMIS_Diagnosa;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Icd;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SatuSehatEncounterService
{
    private $uuid_encounter = '';
    private $uuid_primer = '';
    private $uuid_sekunder1 = '';
    private $uuid_sekunder2 = '';
    private $uuid_sekunder3 = '';
    private $uuid_sekunder4 = '';
    private $uuid_sekunder5 = '';

    function __construct()
    {
        $this->uuid_encounter = '';
        $this->uuid_primer = '';
        $this->uuid_sekunder1 = '';
        $this->uuid_sekunder2 = '';
        $this->uuid_sekunder3 = '';
        $this->uuid_sekunder4 = '';
        $this->uuid_sekunder5 = '';
    }

    function add($layanan, $pasien, $jadwal, $antrian)
    {
        $employee = SmisHrdEmployee::where('id', $jadwal->id_dokter)->first();
        $lokasi = SatuSehatLocation::where('nama', $jadwal->nama_poli)->first();
        $data = [
            "resourceType" => "Encounter",
            "status" => 'arrived',
            "class" => json_decode(json_encode([
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ])),
            "subject" => json_decode(json_encode([
                "reference" => "Patient/" . $pasien->ihs_number,
                "display" => $pasien->nama
            ])),
            "participant" => [
                json_decode(json_encode([
                    "type" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]))
                            ]
                        ]))
                    ],
                    "individual" => json_decode(json_encode([
                        "reference" => "Practitioner/" . ($employee ? $employee->ihs_number : ''),
                        "display" => $employee ? $employee->nama : ''
                    ]))
                ]))
            ],
            "period" => json_decode(json_encode([
                "start" => (new DateTime('now', new \DateTimeZone("Asia/Jakarta")))->format('c')
            ])),
            "location" => [
                json_decode(json_encode([
                    "location" => json_decode(json_encode([
                        "reference" => "Location/" . ($lokasi ? $lokasi->id_lokasi : ''),
                        "display" => $lokasi ? $lokasi->nama : ''
                    ]))
                ]))
            ],
            "statusHistory" => [
                json_decode(json_encode([
                    "status" => "arrived",
                    "period" => json_decode(json_encode([
                        "start" => (new DateTime('now', new \DateTimeZone("Asia/Jakarta")))->format('c')
                    ]))
                ]))
            ],
            "serviceProvider" => json_decode(json_encode([
                "reference" => "Organization/" . env('IHS_RS')
            ])),
            "identifier" => [
                json_decode(json_encode([
                    "system" => "http://sys-ids.kemkes.go.id/encounter/" . env('IHS_RS'),
                    "value" => (string) $layanan['id']
                ]))
            ]
        ];

        $sss = new SatuSehatService();
        $add = $sss->post(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Encounter', json_encode($data));

        if ($add->getStatusCode() == 401) {
            $autentikasi = json_decode($sss->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
            return [
                'status' => false,
                'message' => 'Gagal terhubung ke satu sehat, token expired',
            ];
        }

        if ($add->getStatusCode() == 201) {
            $data = json_decode($add->getBody()->getContents());
            $update = Antrian::where('id', $antrian->id)->update([
                'id_encounter' => $data->id,
            ]);
            return [
                'status' => true,
                'message' => 'Ok',
            ];
        } else {
            $failed = json_decode($add->getBody()->getContents());
            return [
                'status' => false,
                'message' => $failed->issue[0]->details->text,
            ];
        }
    }

    function update_inprogress($antrian, $waktu)
    {
        $pasien = SMIS_Pasien::where('id', $antrian->norm)->first();
        $jadwal = JadwalPoli::findOrFail($antrian->jadwal_id);
        $layanan = SMIS_LayananPasien::findOrFail($antrian->noreg);
        $employee = SmisHrdEmployee::where('id', $jadwal->id_dokter)->first();
        $lokasi = SatuSehatLocation::where('nama', $jadwal->nama_poli)->first();
        $data = [
            "resourceType" => "Encounter",
            "id" => $antrian->id_encounter,
            "identifier" => [
                json_decode(json_encode([
                    "system" => "http://sys-ids.kemkes.go.id/encounter/" . env('IHS_RS'),
                    "value" => (string) $layanan->id
                ]))
            ],
            "status" => 'in-progress',
            "class" => json_decode(json_encode([
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ])),
            "subject" => json_decode(json_encode([
                "reference" => "Patient/" . $pasien->ihs_number,
                "display" => $pasien->nama
            ])),
            "participant" => [
                json_decode(json_encode([
                    "type" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]))
                            ]
                        ]))
                    ],
                    "individual" => json_decode(json_encode([
                        "reference" => "Practitioner/" . ($employee ? $employee->ihs_number : ''),
                        "display" => $employee ? $employee->nama : ''
                    ]))
                ]))
            ],
            "period" => json_decode(json_encode([
                "start" => (new DateTime(date('Y-m-d H:i:s', (($antrian->waktu_taskid_empat / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                "end" => (new DateTime(date('Y-m-d H:i:s', (($waktu / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c')
            ])),
            "location" => [
                json_decode(json_encode([
                    "location" => json_decode(json_encode([
                        "reference" => "Location/" . ($lokasi ? $lokasi->id_lokasi : ''),
                        "display" => $lokasi ? $lokasi->nama : ''
                    ]))
                ]))
            ],
            "statusHistory" => [
                json_decode(json_encode([
                    "status" => "arrived",
                    "period" => json_decode(json_encode([
                        "start" => (new DateTime(date('Y-m-d H:i:s', (($antrian->waktu_checkin / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                        "end" => (new DateTime(date('Y-m-d H:i:s', (($antrian->waktu_taskid_empat / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                    ]))
                ])),
                json_decode(json_encode([
                    "status" => "in-progress",
                    "period" => json_decode(json_encode([
                        "start" => (new DateTime(date('Y-m-d H:i:s', (($antrian->waktu_taskid_empat / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                        "end" => (new DateTime(date('Y-m-d H:i:s', (($waktu / 1000) + 25200)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                    ]))
                ]))
            ],
            "serviceProvider" => json_decode(json_encode([
                "reference" => "Organization/" . env('IHS_RS')
            ]))
        ];

        $sss = new SatuSehatService();
        $add = $sss->put(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Encounter/' . $antrian->id_encounter, json_encode($data));

        if ($add->getStatusCode() == 401) {
            $autentikasi = json_decode($sss->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
            return [
                'status' => false,
                'message' => 'Gagal terhubung ke satu sehat, token expired',
            ];
        }

        if ($add->getStatusCode() == 200) {
            $data = json_decode($add->getBody()->getContents());
            $update = Antrian::where('id', $antrian->id)->update([
                'id_encounter' => $data->id,
            ]);
            return [
                'status' => true,
                'message' => 'Ok',
            ];
        } else {
            $failed = json_decode($add->getBody()->getContents());
            return [
                'status' => false,
                'message' => $failed->issue[0]->details->text,
            ];
        }
    }

    function bundle($layanan)
    {
        $pasien = SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first();
        $diagnosa = SMIS_Diagnosa::where('noreg_pasien', $layanan->id)->where('prop', '')->first();

        $this->uuid_encounter = $this->generate_uuid();

        $data = $this->append_second_diagnosis($layanan, $pasien, $diagnosa);
        
        return $data;
    }

    function append_second_diagnosis($layanan, $pasien, $diagnosa)
    {
        $entry = $this->entry_bundle($pasien, $diagnosa, $layanan);

        return json_decode(json_encode([
            "resourceType" => "Bundle",
            "type" => "transaction",
            "entry" => $entry
        ]));
    }

    function entry_bundle($pasien, $diagnosa, $layanan){
        $employee = SmisHrdEmployee::where('id', $layanan->id_dokter)->where('prop', '')->first();
        $location = SatuSehatLocation::where('nama', $layanan->last_nama_ruangan)->first();
        $rwt = DB::table('smis_rwt_antrian_' . $layanan->jenislayanan)->where('no_register', $layanan->id)->where('prop', '')->first();
        $arr = [
            json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_encounter,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Encounter",
                    "status" => "finished",
                    "class" => json_decode(json_encode([
                        "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                        "code" => "AMB",
                        "display" => "ambulatory"
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ""
                    ])),
                    "participant" => [
                        json_decode(json_encode([
                            "type" => [
                                json_decode(json_encode([
                                    "coding" => [
                                        json_decode(json_encode([
                                            "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                            "code" => "ATND",
                                            "display" => "attender"
                                        ]))
                                    ]
                                ]))
                            ],
                            "individual" => json_decode(json_encode([
                                "reference" => "Practitioner/" . ($employee ? $employee->ihs_number : ''),
                                "display" => $layanan->nama_dokter
                            ]))
                        ]))
                    ],
                    "period" => json_decode(json_encode([
                        "start" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                        "end" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal_pulang)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                    ])),
                    "location" => [
                        json_decode(json_encode([
                            "location" => json_decode(json_encode([
                                "reference" => "Location/" . ($location ? $location->id_lokasi : ''),
                                "display" => ($location ? $location->deskripsi : '')
                            ]))
                        ]))
                    ],
                    "diagnosis" => $this->diagnosis($diagnosa),
                    "statusHistory" => [
                        json_decode(json_encode([
                            "status" => "arrived",
                            "period" => json_decode(json_encode([
                                "start" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                                "end" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                            ]))
                        ])),
                        json_decode(json_encode([
                            "status" => "in-progress",
                            "period" => json_decode(json_encode([
                                "start" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                                "end" => (new DateTime(date('Y-m-d H:i:s', strtotime($rwt->waktu_keluar)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                            ]))
                        ])),
                        json_decode(json_encode([
                            "status" => "finished",
                            "period" => json_decode(json_encode([
                                "start" => (new DateTime(date('Y-m-d H:i:s', strtotime($rwt->waktu_keluar)), new \DateTimeZone("Asia/Jakarta")))->format('c'),
                                "end" => (new DateTime(date('Y-m-d H:i:s', strtotime($layanan->tanggal_pulang)), new \DateTimeZone("Asia/Jakarta")))->format('c')
                            ]))
                        ]))
                    ],
                    "serviceProvider" => json_decode(json_encode([
                        "reference" => "Organization/" . env('IHS_RS')
                    ])),
                    "identifier" => [
                        json_decode(json_encode([
                            "system" => "http://sys-ids.kemkes.go.id/encounter/" . env('IHS_RS'),
                            "value" => (string) $layanan->id
                        ]))
                    ]
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Encounter"
                ]))
            ])),
            json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_primer,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $diagnosa ? $diagnosa->kode_icd : "",
                                "display" => $diagnosa ? $diagnosa->nama_icd : ""
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ""
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : "") . " di hari " . $this->hari(date("Y-m-d", strtotime($layanan->tanggal))) . ", " . date("d", strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date("m", strtotime($layanan->tanggal))) . " " . date("Y", strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ]))
        ];
        $arr = $this->json_diagnosa($arr, $diagnosa, $pasien, $layanan);
        return $arr;
    }

    function json_diagnosa($arr, $diagnosa, $pasien, $layanan)
    {
        $entry = $arr;
        $icd1 = Smis_Mr_Icd::where('nama', 'like', '%' . $diagnosa->diagnosa_sekunder1 . '%')->where('prop', '')->first();
        $icd2 = Smis_Mr_Icd::where('nama', 'like', '%' . $diagnosa->diagnosa_sekunder2 . '%')->where('prop', '')->first();
        $icd3 = Smis_Mr_Icd::where('nama', 'like', '%' . $diagnosa->diagnosa_sekunder3 . '%')->where('prop', '')->first();
        $icd4 = Smis_Mr_Icd::where('nama', 'like', '%' . $diagnosa->diagnosa_sekunder4 . '%')->where('prop', '')->first();
        $icd5 = Smis_Mr_Icd::where('nama', 'like', '%' . $diagnosa->diagnosa_sekunder5 . '%')->where('prop', '')->first();

        if ($diagnosa->diagnosa_sekunder1 != '' && $diagnosa->diagnosa_sekunder1 != null) {
            array_push($entry,json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_sekunder1,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $icd1 ? $icd1->icd : '',
                                "display" => $diagnosa ? $diagnosa->diagnosa_sekunder1 : ''
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ''
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : '') . " di hari " . $this->hari(date('Y-m-d', strtotime($layanan->tanggal))) . ", " . date('d', strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date('m', strtotime($layanan->tanggal))) . " " . date('Y', strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ])));
        }

        if ($diagnosa->diagnosa_sekunder2 != '' && $diagnosa->diagnosa_sekunder2 != null) {
            array_push($entry,json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_sekunder2,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $icd2 ? $icd2->icd : '',
                                "display" => $diagnosa ? $diagnosa->diagnosa_sekunder2 : ''
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ''
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : '') . " di hari " . $this->hari(date('Y-m-d', strtotime($layanan->tanggal))) . ", " . date('d', strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date('m', strtotime($layanan->tanggal))) . " " . date('Y', strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ])));
        }

        if ($diagnosa->diagnosa_sekunder3 != '' && $diagnosa->diagnosa_sekunder3 != null) {
            array_push($entry, json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_sekunder3,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $icd3 ? $icd3->icd : '',
                                "display" => $diagnosa ? $diagnosa->diagnosa_sekunder3 : ''
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ''
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : '') . " di hari " . $this->hari(date('Y-m-d', strtotime($layanan->tanggal))) . ", " . date('d', strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date('m', strtotime($layanan->tanggal))) . " " . date('Y', strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ])));
        }

        if ($diagnosa->diagnosa_sekunder4 != '' && $diagnosa->diagnosa_sekunder4 != null) {
            array_push($entry, json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_sekunder4,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $icd4 ? $icd4->icd : '',
                                "display" => $diagnosa ? $diagnosa->diagnosa_sekunder4 : ''
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ''
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : '') . " di hari " . $this->hari(date('Y-m-d', strtotime($layanan->tanggal))) . ", " . date('d', strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date('m', strtotime($layanan->tanggal))) . " " . date('Y', strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ])));
        }

        if ($diagnosa->diagnosa_sekunder5 != '' && $diagnosa->diagnosa_sekunder5 != null) {
            array_push($entry, json_decode(json_encode([
                "fullUrl" => "urn:uuid:" . $this->uuid_sekunder5,
                "resource" => json_decode(json_encode([
                    "resourceType" => "Condition",
                    "clinicalStatus" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                "code" => "active",
                                "display" => "Active"
                            ]))
                        ]
                    ])),
                    "category" => [
                        json_decode(json_encode([
                            "coding" => [
                                json_decode(json_encode([
                                    "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                    "code" => "encounter-diagnosis",
                                    "display" => "Encounter Diagnosis"
                                ]))
                            ]
                        ]))
                    ],
                    "code" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => $icd5 ? $icd5->icd : '',
                                "display" => $diagnosa ? $diagnosa->diagnosa_sekunder5 : ''
                            ]))
                        ]
                    ])),
                    "subject" => json_decode(json_encode([
                        "reference" => "Patient/" . ($pasien ? $pasien->ihs_number : ""),
                        "display" => $pasien ? $pasien->nama : ''
                    ])),
                    "encounter" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_encounter,
                        "display" => "Kunjungan " . ($pasien ? $pasien->nama : '') . " di hari " . $this->hari(date('Y-m-d', strtotime($layanan->tanggal))) . ", " . date('d', strtotime($layanan->tanggal)) . " " . $this->reformat_bulan_indo(date('m', strtotime($layanan->tanggal))) . " " . date('Y', strtotime($layanan->tanggal))
                    ]))
                ])),
                "request" => json_decode(json_encode([
                    "method" => "POST",
                    "url" => "Condition"
                ]))
            ])));
        }

        return $entry;
    }

    function diagnosis($diagnosa)
    {
        $diagnosis = [];

        $this->uuid_primer = $this->generate_uuid();
        $this->uuid_sekunder1 = $this->generate_uuid();
        $this->uuid_sekunder2 = $this->generate_uuid();
        $this->uuid_sekunder3 = $this->generate_uuid();
        $this->uuid_sekunder4 = $this->generate_uuid();
        $this->uuid_sekunder5 = $this->generate_uuid();

        if ($diagnosa != null) {
            array_push($diagnosis, json_decode(json_encode([
                "condition" => json_decode(json_encode([
                    "reference" => "urn:uuid:" . $this->uuid_primer,
                    "display" => $diagnosa ? $diagnosa->nama_icd : ""
                ])),
                "use" => json_decode(json_encode([
                    "coding" => [
                        json_decode(json_encode([
                            "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                            "code" => "DD",
                            "display" => "Discharge diagnosis"
                        ]))
                    ]
                ])),
                "rank" => 1
            ])));

            if ($diagnosa->diagnosa_sekunder1 != '' && $diagnosa->diagnosa_sekunder1 != null) {
                array_push($diagnosis, json_decode(json_encode([
                    "condition" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_sekunder1,
                        "display" => $diagnosa ? $diagnosa->diagnosa_sekunder1 : ''
                    ])),
                    "use" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]))
                        ]
                    ])),
                    "rank" => 2
                ])));
            }

            if ($diagnosa->diagnosa_sekunder2 != '' && $diagnosa->diagnosa_sekunder2 != null) {
                array_push($diagnosis, json_decode(json_encode([
                    "condition" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_sekunder2,
                        "display" => $diagnosa ? $diagnosa->diagnosa_sekunder2 : ''
                    ])),
                    "use" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]))
                        ]
                    ])),
                    "rank" => 3
                ])));
            }

            if ($diagnosa->diagnosa_sekunder3 != '' && $diagnosa->diagnosa_sekunder3 != null) {
                array_push($diagnosis, json_decode(json_encode([
                    "condition" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_sekunder3,
                        "display" => $diagnosa ? $diagnosa->diagnosa_sekunder3 : ''
                    ])),
                    "use" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]))
                        ]
                    ])),
                    "rank" => 4
                ])));
            }

            if ($diagnosa->diagnosa_sekunder4 != '' && $diagnosa->diagnosa_sekunder4 != null) {
                array_push($diagnosis, json_decode(json_encode([
                    "condition" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_sekunder4,
                        "display" => $diagnosa ? $diagnosa->diagnosa_sekunder4 : ''
                    ])),
                    "use" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]))
                        ]
                    ])),
                    "rank" => 5
                ])));
            }

            if ($diagnosa->diagnosa_sekunder5 != '' && $diagnosa->diagnosa_sekunder5 != null) {
                array_push($diagnosis, json_decode(json_encode([
                    "condition" => json_decode(json_encode([
                        "reference" => "urn:uuid:" . $this->uuid_sekunder5,
                        "display" => $diagnosa ? $diagnosa->diagnosa_sekunder5 : ''
                    ])),
                    "use" => json_decode(json_encode([
                        "coding" => [
                            json_decode(json_encode([
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharge diagnosis"
                            ]))
                        ]
                    ])),
                    "rank" => 6
                ])));
            }
        }
        return $diagnosis;
    }

    function reformat_bulan_indo($param)
    {
        if ($param == '' || $param == null) {
            return '';
        }
        switch ($param) {
            case '01':
                return 'Januari';
                break;
            case '02':
                return 'Februari';
                break;
            case '03':
                return 'maret';
                break;
            case '04':
                return 'April';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Juni';
                break;
            case '07':
                return 'Juli';
                break;
            case '08':
                return 'Agustus';
                break;
            case '09':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default:
                return '';
                break;
        }
    }

    function hari($param)
    {
        if ($param == '' || $param == null) {
            return '';
        }

        switch (date('w', strtotime($param))) {
            case '0':
                return 'Minggu';
                break;
            case '1':
                return 'Senin';
                break;
            case '2':
                return 'Selasa';
                break;
            case '3':
                return 'Rabu';
                break;
            case '4':
                return 'Kamis';
                break;
            case '5':
                return "Jum'at";
                break;
            case '6':
                return 'Sabtu';
                break;
            default:
                return '';
                break;
        }
    }

    function generate_uuid()
    {
        $data = openssl_random_pseudo_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
    }
}
