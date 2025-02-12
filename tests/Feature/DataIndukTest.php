<?php

namespace Tests\Feature;

use Tests\TestCase;

class DataIndukTest extends TestCase
{
    private function do_login()
    {
        $_SERVER['HTTP_CLIENT_IP'] = '127.0.0.1';
        $this->post('/do_login', [
            "username" => "admin",
            "password" => "default"
        ]);
    }

    public function testDataIndukBagianIndex()
    {
        $this->do_login();
        $response = $this->get('hrd/data_induk/bagian');
        $response->assertStatus(200);
    }

    public function testDataIndukRuanganPegawaiIndex()
    {
        $this->do_login();
        $response = $this->get('hrd/data_induk/ruangan_pegawai');
        $response->assertStatus(200);
    }

    public function testDataIndukStatusTenagaIndex()
    {
        $this->do_login();
        $response = $this->get('hrd/data_induk/status_tenaga');
        $response->assertStatus(200);
    }

    public function testDataIndukPendidikanIndex()
    {
        $this->do_login();
        $response = $this->get('hrd/data_induk/pendidikan');
        $response->assertStatus(200);
    }
}
