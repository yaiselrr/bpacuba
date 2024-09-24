<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\GeneralInfo;
class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        factory(GeneralInfo::class, 1)->create(
            [
                'tipo'=> 'actividad-internacional'
            ]
        );
        factory(GeneralInfo::class, 1)->create(
            [
                'tipo'=> 'tasa_interes',
                'home_text' => $faker->paragraph(),
            ]
        );
        factory(GeneralInfo::class, 1)->create(
            [
                'tipo'=> 'tarifas-terminos',
            ]
        );
        factory(GeneralInfo::class, 1)->create(
            [
                'tipo'=> 'info-financiera'
            ]
        );
    }
}
