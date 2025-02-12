<?php

namespace Tests\Feature;

use Tests\TestCase;

class InvoiceTest extends TestCase
{
    private function do_login()
    {
        $_SERVER['HTTP_CLIENT_IP'] = '127.0.0.1';
        $this->post('/do_login', [
            "username" => "admin",
            "password" => "default"
        ]);
    }

    public function testInvoiceIndex()
    {
        $this->do_login();
        $response = $this->get('keuangan_kas_bank/invoice');
        $response->assertStatus(200);
    }

    public function testInvoiceCreate()
    {
        $this->do_login();
        $response = $this->get('keuangan_kas_bank/invoice/create');
        $response->assertStatus(200);
    }
}
