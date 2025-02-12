<?php

namespace Tests\Feature;

use Tests\TestCase;

class DataKaryawanTest extends TestCase
{
    use LoginTrait;

    public function testKaryawanIndex()
    {
        $this->do_login();
        $response = $this->get('hrd/data_karyawan');
        $response->assertStatus(200);
    }

    public function testKaryawanCreate()
    {
        $this->do_login();
        $response = $this->get('hrd/data_karyawan/create');
        $response->assertStatus(200);
    }
}
