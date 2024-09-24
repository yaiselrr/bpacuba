<?php

use Illuminate\Database\Seeder;
use App\Models\ChangeTax;
use Illuminate\Http\File;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image =base_path('public/files/taxes.png');
        $ch= ChangeTax::firstOrCreate([
            'imagen' => Storage::disk('public')->putFile('info',new File($image))
        ]);



    }
}
