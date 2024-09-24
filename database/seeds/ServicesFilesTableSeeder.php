<?php

use Illuminate\Database\Seeder;
use App\Models\Services;
use App\Models\ServicesFiles;
class ServicesFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1= Services::where('tipo', 'banca-electronica')->firstOrFail();
        $s2= Services::where('tipo', 'banca-corporativa')->firstOrFail();
        $s3= Services::where('tipo', 'banca-personal')->firstOrFail();
        $s4= Services::where('tipo', 'tcp-cna')->firstOrFail();
        factory(ServicesFiles::class, 4)->create(
            [
                'services_id'=> $s1->id
            ]
        );
        factory(ServicesFiles::class, 4)->create(
            [
                'services_id'=> $s2->id
            ]
        );
        factory(ServicesFiles::class, 4)->create(
            [
                'services_id'=> $s3->id
            ]
        );
        factory(ServicesFiles::class, 4)->create(
            [
                'services_id'=> $s4->id
            ]
        );

    }
}
