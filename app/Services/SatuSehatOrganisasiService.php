<?php

namespace App\Services;

use App\Models\SatuSehatOrganisasi;
use App\Models\SatuSehatReferensiOrganisasi;
use GuzzleHttp\Client;

class SatuSehatOrganisasiService
{

    public function store($req, $data)
    {
        $ref = SatuSehatReferensiOrganisasi::findOrFail($req->tipe);
        $create = SatuSehatOrganisasi::create([
            'id_organisasi' => $data->id,
            'tipe' => $ref->display,
            'nama' => $req->nama,
            'aktif' => $req->active,
            'telepon' => $req->telepon,
            'email' => $req->email,
            'alamat' => $req->alamat,
            'part_of' => $req->part_of
        ]);

        return $create;
    }

    public function update($req)
    {
        $ref = SatuSehatReferensiOrganisasi::findOrFail($req->tipe);
        $create = SatuSehatOrganisasi::where('id', $req->id)->update([
            'tipe' => $ref->display,
            'nama' => $req->nama,
            'aktif' => $req->active,
            'telepon' => $req->telepon,
            'email' => $req->email,
            'alamat' => $req->alamat,
            'part_of' => $req->part_of
        ]);

        return $create;
    }

    function store_referensi($data)
    {
        SatuSehatReferensiOrganisasi::truncate();
        for ($i = 1; $i < sizeof($data->tr); $i++) {
            SatuSehatReferensiOrganisasi::create([
                'code' => $data->tr[$i]->td[0],
                'display' => $data->tr[$i]->td[1],
                'definition' => $data->tr[$i]->td[2],
            ]);
        }

        return true;
    }

    public function data_add_organisasi($req)
    {
        $ref = SatuSehatReferensiOrganisasi::where('id', $req->tipe)->first();
        $active = $req->active == 1 ? true : false;
        $code = $ref ? $ref->code : '';
        $display = $ref ? $ref->display : '';
        $data = [
            "resourceType" => "Organization",
            "active" => $active,
            "identifier" => [
                json_decode(json_encode([
                    "use" => "official",
                    "system" => "http://sys-ids.kemkes.go.id/organization/".env('IHS_RS'),
                    "value" => $req->nama
                ]))
            ],
            "type" => [
                json_decode(json_encode([
                    "coding" => [
                        json_decode(json_encode([
                            "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
                            "code" => $code,
                            "display" => "$display"
                        ]))
                    ]
                ]))
            ],
            "name" => $req->nama,
            "telecom" => [
                json_decode(json_encode([
                    "system" => "phone",
                    "value" => $this->str_replace_first('0', '+62', $req->telepon),
                    "use" => "work"
                ])),
                json_decode(json_encode([
                    "system" => "email",
                    "value" => $req->email,
                    "use" => "work"
                ])),
                json_decode(json_encode([
                    "system" => "url",
                    "value" => "",
                    "use" => "work"
                ]))
            ],
            "address" => [
                json_decode(json_encode([
                    "use" => "work",
                    "type" => "both",
                    "line" => [
                        $req->alamat
                    ],
                    "city" => "",
                    "postalCode" => "",
                    "country" => "",
                    // "extension"=> [
                    //     json_decode(json_encode([
                    //         "url"=> "https=>//fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                    //         "extension"=> [
                    //             json_decode(json_encode([
                    //                 "url"=> "province",
                    //                 "valueCode"=> "31"
                    //             ])),
                    //             json_decode(json_encode([
                    //                 "url"=> "city",
                    //                 "valueCode"=> "3171"
                    //             ])),
                    //             json_decode(json_encode([
                    //                 "url"=> "district",
                    //                 "valueCode"=> "317101"
                    //             ])),
                    //             json_decode(json_encode([
                    //                 "url"=> "village",
                    //                 "valueCode"=> "31710101"
                    //             ]))
                    //         ]
                    //     ]))
                    // ]
                ]))
            ],
            "partOf" => json_decode(json_encode([
                "reference" => 'Organization/' . $req->part_of
            ]))
        ];
        return $data;
    }

    public function data_edit_organisasi($req)
    {
        $ref = SatuSehatReferensiOrganisasi::where('id', $req->tipe)->first();
        $active = $req->active == 1 ? true : false;
        $code = $ref ? $ref->code : '';
        $display = $ref ? $ref->display : '';
        $data = [
            "resourceType" => "Organization",
            "active" => $active,
            "id" => $req->id_organisasi,
            "identifier" => [
                json_decode(json_encode([
                    "use" => "official",
                    "system" => "http://sys-ids.kemkes.go.id/organization/".env('IHS_RS'),
                    "value" => $req->nama
                ]))
            ],
            "type" => [
                json_decode(json_encode([
                    "coding" => [
                        json_decode(json_encode([
                            "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
                            "code" => $code,
                            "display" => "$display"
                        ]))
                    ]
                ]))
            ],
            "name" => $req->nama,
            "telecom" => [
                json_decode(json_encode([
                    "system" => "phone",
                    "value" => $this->str_replace_first('0', '+62', $req->telepon),
                    "use" => "work"
                ])),
                json_decode(json_encode([
                    "system" => "email",
                    "value" => $req->email,
                    "use" => "work"
                ])),
                json_decode(json_encode([
                    "system" => "url",
                    "value" => "",
                    "use" => "work"
                ]))
            ],
            "address" => [
                json_decode(json_encode([
                    "use" => "work",
                    "type" => "both",
                    "line" => [
                        $req->alamat
                    ],
                    "city" => "",
                    "postalCode" => "",
                    "country" => "",
                ]))
            ],
            "partOf" => json_decode(json_encode([
                "reference" => 'Organization/' . $req->part_of
            ]))
        ];
        return $data;
    }

    function str_replace_first($search, $replace, $subject)
    {
        $search = '/' . preg_quote($search, '/') . '/';
        return preg_replace($search, $replace, $subject, 1);
    }
}
