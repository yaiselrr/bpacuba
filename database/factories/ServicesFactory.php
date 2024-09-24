<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Services;
use Faker\Generator as Faker;
use Illuminate\Http\File;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Services::class, function (Faker $faker) {
//    $from =base_path('public/files/default.png');
    return [
        'descripcion' =>$faker->paragraph,
        'valoracion' =>$faker->paragraph,
//        'imagen' => Storage::disk('public')->putFile('services',new File($from))
    ];
});
