<?php

use Illuminate\Database\Seeder;
use App\Models\Services;
use App\Models\ServicesFiles;
class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Services::class, 1)->create(
            [
                'tipo'=> 'banca-electronica'
            ]
        );
        factory(Services::class, 1)->create(
            [
                'tipo'=> 'banca-corporativa'
            ]
        );
        factory(Services::class, 1)->create(
            [
                'tipo'=> 'banca-personal'
            ]
        );
        factory(Services::class, 1)->create(
            [
                'tipo'=> 'tcp-cna'
            ]
        );
    }
}
