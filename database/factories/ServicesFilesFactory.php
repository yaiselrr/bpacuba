<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\ServicesFiles;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

$factory->define(ServicesFiles::class, function (Faker $faker) {
    $from =base_path('public/files/default.pdf');
    return [
        'nombre' => $faker->name,
        'fichero' => Storage::disk('public')->putFile('services',new File($from))
    ];
});
