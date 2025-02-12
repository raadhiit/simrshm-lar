<?php

namespace Tests\Feature;

use Tests\TestCase;

class KeuanganTest extends TestCase
{
    private function do_login()
    {
        $_SERVER['HTTP_CLIENT_IP'] = '127.0.0.1';
        $this->post('/do_login', [
            "username" => "admin",
            "password" => "default"
        ]);
    }

    public function testIndex()
    {
        $this->do_login();
        $response = $this->get('keuangan/');
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $this->do_login();
        $response = $this->post('keuangan/create', [
            'deskripsi' => 'test',
            'id' => '2'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('keuangan');
    }
}
