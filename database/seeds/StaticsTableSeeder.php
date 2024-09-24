<?php

use Illuminate\Database\Seeder;
use App\Models\Statics;
use Faker\Factory as Faker;
class StaticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        ['generales', 'descargas',
//            'redes-oficinas', 'tarifas-terminos',
//            'cajeros','productos-servicios']
        $faker = Faker::create();
        Statics::firstOrCreate([
            'descripcion' => $faker->paragraph(),
            'tipo' => 'generales'
        ]);
        Statics::firstOrCreate([
            'descripcion' => $faker->paragraph(),
            'tipo' => 'descargas'
        ]);
        Statics::firstOrCreate([
            'descripcion' => $faker->paragraph(),
            'tipo' => 'redes-oficinas'
        ]);
        Statics::firstOrCreate([
            'descripcion' => $faker->paragraph(),
            'tipo' => 'cajeros'
        ]);
        Statics::firstOrCreate([
            'home_text' => $faker->paragraph(),
            'descripcion' => $faker->paragraph(),
            'tipo' => 'productos-servicios'
        ]);

    }
}
