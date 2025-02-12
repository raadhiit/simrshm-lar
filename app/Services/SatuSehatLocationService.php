<?php

namespace App\Services;

use App\Models\SatuSehatLocation;
use App\Models\SatuSehatLocationReference;
use Illuminate\Support\Facades\Session;

class SatuSehatLocationService{
    function update_referensi(){
        $sss = new SatuSehatService();
        $xml = simplexml_load_string($sss->get('http://terminology.hl7.org/CodeSystem/location-physical-type')->getBody()->getContents());
        $data = $xml->text->div->table;
        SatuSehatLocationReference::truncate();
        for ($i = 1; $i < sizeof($data->tr); $i++) {
            SatuSehatLocationReference::updateOrCreate([
                'code' => $data->tr[$i]->td[0],
            ],[
                'display' => $data->tr[$i]->td[1],
                'definition' => $data->tr[$i]->td[2],
            ]);
        }
        return true;
    }

    function store($req){
        $ref = SatuSehatLocationReference::where('id', $req->tipe)->first();
        $code = $ref ? $ref->code : '';
        $display = $ref ? $ref->display : '';
        $data = [
            "resourceType"=> "Location",
            "identifier"=> [
                // json_decode(json_encode([
                //     "system"=> "http=>//sys-ids.kemkes.go.id/location/1000001",
                //     "value"=> "G-2-R-1A"
                // ]))
            ],
            "status"=> $req->status,
            "name"=> $req->nama,
            "description"=> $req->deskripsi,
            "telecom"=> [
                json_decode(json_encode([
                    "system"=> "phone",
                    "value"=> $req->telepon,
                    "use"=> "work"
                ])),
                json_decode(json_encode([
                    "system"=> "email",
                    "value"=> $req->email
                ]))
            ],
            "address"=> json_decode(json_encode([
                "use"=> "work",
                "line"=> [
                    ""
                ],
                "city"=> "",
                "postalCode"=> "",
                "country"=> "",
            ])),
            "physicalType"=> json_decode(json_encode([
                "coding"=> [
                    json_decode(json_encode([
                        "system"=> "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code"=> $code,
                        "display"=> $display
                    ]))
                ]
            ])),
            // "position"=> json_decode(json_encode([
            //     "longitude"=> -6.23115426275766,
            //     "latitude"=> 106.83239885393944,
            //     "altitude"=> 0
            // ])),
            "managingOrganization"=> json_decode(json_encode([
                "reference"=> "Organization/".$req->dikelola_oleh
            ]))
        ];

        $sss = new SatuSehatService();

        $result = $sss->post(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Location', json_encode($data));

        if ($result->getStatusCode() == 401) {
            $autentikasi = json_decode($sss->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
            return [
                'status' => false,
                'message' => 'Token expired, silahkan coba kembali'
            ];
        }

        $data = json_decode($result->getBody()->getContents());

        if ($result->getStatusCode() == 201) {
            SatuSehatLocation::create([
                'id_lokasi' => $data->id,
                'kode_tipe' => $ref->code,
                'tipe' => $ref->display,
                'nama' => $req->nama,
                'deskripsi' => $req->deskripsi,
                'telepon' => $req->telepon,
                'email' => $req->email,
                'status' => $req->status,
                'dikelola_oleh' => $req->dikelola_oleh
            ]);
            return [
                'status' => true,
                'message' => 'Data tersimpan'
            ];
        } else {
            return [
                'status' => false,
                'message' => $data->issue[0]->details->text
            ];
        }
    }

    function update($req){
        $ref = SatuSehatLocationReference::where('id', $req->tipe)->first();
        $code = $ref ? $ref->code : '';
        $display = $ref ? $ref->display : '';
        $data = [
            "resourceType"=> "Location",
            "id"=> $req->id_lokasi,
            "identifier"=> [
                // json_decode(json_encode([
                //     "system"=> "http=>//sys-ids.kemkes.go.id/location/1000001",
                //     "value"=> "G-2-R-1A"
                // ]))
            ],
            "status"=> $req->status,
            "name"=> $req->nama,
            "description"=> $req->deskripsi,
            "telecom"=> [
                json_decode(json_encode([
                    "system"=> "phone",
                    "value"=> $req->telepon,
                    "use"=> "work"
                ])),
                json_decode(json_encode([
                    "system"=> "email",
                    "value"=> $req->email
                ]))
            ],
            "address"=> json_decode(json_encode([
                "use"=> "work",
                "line"=> [
                    ""
                ],
                "city"=> "",
                "postalCode"=> "",
                "country"=> "",
            ])),
            "physicalType"=> json_decode(json_encode([
                "coding"=> [
                    json_decode(json_encode([
                        "system"=> "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code"=> $code,
                        "display"=> $display
                    ]))
                ]
            ])),
            // "position"=> json_decode(json_encode([
            //     "longitude"=> -6.23115426275766,
            //     "latitude"=> 106.83239885393944,
            //     "altitude"=> 0
            // ])),
            "managingOrganization"=> json_decode(json_encode([
                "reference"=> "Organization/".$req->dikelola_oleh
            ]))
        ];
        
        $sss = new SatuSehatService();

        $result = $sss->put(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Location/'.$req->id_lokasi, json_encode($data));

        if ($result->getStatusCode() == 401) {
            $autentikasi = json_decode($sss->auth());
            Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
            return [
                'status' => false,
                'message' => 'Token expired, silahkan coba kembali'
            ];
        }

        $data = json_decode($result->getBody()->getContents());

        if ($result->getStatusCode() == 200) {
            SatuSehatLocation::where('id', $req->id)->update([
                'kode_tipe' => $ref->code,
                'tipe' => $ref->display,
                'nama' => $req->nama,
                'deskripsi' => $req->deskripsi,
                'telepon' => $req->telepon,
                'email' => $req->email,
                'status' => $req->status,
                'dikelola_oleh' => $req->dikelola_oleh
            ]);
            return [
                'status' => true,
                'message' => 'Data tersimpan'
            ];
        } else {
            return [
                'status' => false,
                'message' => $data->issue[0]->details->text
            ];
        }
    }
}