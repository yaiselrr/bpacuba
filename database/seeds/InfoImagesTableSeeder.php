<?php

use Illuminate\Database\Seeder;
use App\Models\GeneralInfo;
use App\Models\ServicesFiles;
use Illuminate\Http\File;

class InfoImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1= GeneralInfo::where('tipo', 'info-financiera')->firstOrFail();
        $s2= GeneralInfo::where('tipo', 'actividad-internacional')->firstOrFail();
        $s3= GeneralInfo::where('tipo', 'tasa_interes')->firstOrFail();
        $s4= GeneralInfo::where('tipo', 'tarifas-terminos')->firstOrFail();
        $image =base_path('public/files/default.png');
        $pdf =base_path('public/files/default.pdf');
        $s2->imagenes()->create(
            [
                'nombre' => 'Códigos de bancos internacionales',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ]
        );
        $s1->imagenes()->create(
            [
                'nombre' => 'Indicadores del BPA',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ]
        );
        $s3->imagenes()->createMany([
            [
                'nombre' => 'Personas Naturales CUP',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ],
            [
                'nombre' => 'Personas Naturales CUC',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ],
            [
                'nombre' => 'Personas Naturales USD',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ],
            [
                'nombre' => 'Personas Jurídicas CUC',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ],
            [
                'nombre' => 'Personas Jurídicas USD',
                'imagen' => Storage::disk('public')->putFile('info',new File($image))
            ]
          ]
        );
        $s4->imagenes()->createMany([
                [
                    'nombre' => 'Personas Naturales',
                    'imagen' => Storage::disk('public')->putFile('info',new File($pdf))
                ],
                [
                    'nombre' => 'Personas Jurídicas',
                    'imagen' => Storage::disk('public')->putFile('info',new File($pdf))
                ],
                [
                    'nombre' => 'Otros Servicios',
                    'imagen' => Storage::disk('public')->putFile('info',new File($pdf))
                ],
            ]
        );

    }
}
