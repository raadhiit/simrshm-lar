<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DataIndukPendidikanSeeder extends Seeder
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
            DB::table('smis_hrd_pendidikan')->insert([
                'pendidikan' => $faker->name,
                'keterangan' => $faker->sentence(6),
                'butuh_lk' => $faker->randomnumber(2, false),
                'butuh_pr' => $faker->randomnumber(2, false),
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
