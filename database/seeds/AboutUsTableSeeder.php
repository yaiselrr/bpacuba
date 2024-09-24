<?php
use App\Models\About;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        About::firstOrCreate([
            'mision' => $faker->paragraph(),
            'vision' => $faker->paragraph(),
            'objetivos' => $faker->paragraph()
        ]);
    }
}
