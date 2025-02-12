<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DataIndukStatusTenagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('smis_hrd_status_tenaga')->insert([
                'status_tenaga' => $faker->jobTitle,
                'keterangan' => $faker->sentence(30),
                'prop' =>  " ",
                'autonomous' => "rshm",
                'duplicate' => 0,
                'origin' => "rshm",
                'origin_id' => 0,
                'time_updated' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'origin_updated' => ''
            ]);
        }
    }
}
