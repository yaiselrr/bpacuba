<?php

use Illuminate\Database\Seeder;
use App\Models\ContactInfo;
use Faker\Factory as Faker;
use Illuminate\Http\File;

class ContactCentralTableSeeder extends Seeder
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
        $image =base_path('public/files/googlemap.png');
        ContactInfo::firstOrCreate([
            'titulo' => $faker->company(),
            'telefono' => $faker->phoneNumber(),
            'direccion' => $faker->paragraph(),
            'descripcion' => $faker->paragraph(),
            'email' => $faker->companyEmail(),
            'imagen' => Storage::disk('public')->putFile('info',new File($image))
        ]);

    }
}
