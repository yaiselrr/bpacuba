<?php

use Illuminate\Database\Seeder;
use App\Models\SiteData;
use Faker\Factory as Faker;
class SiteDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        SiteData::firstOrCreate(['visitas' => 0,
                                'actualizacion' => \Carbon\Carbon::now()
                                ]);

    }
}
