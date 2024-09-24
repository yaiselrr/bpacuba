<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::generateFor('roles','Roles');
        Permission::generateFor('users','Usuarios');
        Permission::generateFor('taxes','Tasas de Cambio');
        Permission::generateFor('pages','Paginas Asociadas');
        Permission::generateFor('news','Noticias');
        Permission::generateFor('terms','Tarifas de Términos');
        Permission::generateFor('downloads','Descargas');
        Permission::generateFor('questions','Preguntas');
        Permission::generateFor('apps','Aplicaciónes');
        Permission::generateFor('type-offices','Tipo de oficinas');
        Permission::generateFor('ranks','Cargos');
        Permission::generateFor('staff','Consejo de dirección');
        Permission::generateFor('socials','Redes sociales');
        Permission::generateFor('provinces','Provincias');
        Permission::generateFor('contacts','Contactos de oficina central');
        Permission::generateFor('sucursal','Contactos de sucursales');
        Permission::generateFor('municipalities','Municipios');
        Permission::generateFor('carousels','Carrusel');
        Permission::generateFor('links','Enlaces de interes');
        Permission::generateFor('atms','Cajeros automáticos');
        Permission::generateFor('offices','Oficinas');
//        Permission::generateFor('surveys','Encuestas');
        Permission::generateFor('squestions','Preg. de encuestas');
        Permission::generateFor('consults','Consultas');
        Permission::generateFor('electronic-bank','Banca electrónica');
        Permission::generateFor('corporative-bank','Banca corporativa');
        Permission::generateFor('personal-bank','Banca personal');
        Permission::generateFor('tcp-cna','TCP-CNA');
        Permission::generateFor('international-activity','Actividades internacionales');
        Permission::generateFor('interes','Tasas de interes');
        Permission::generateFor('finances-info','Info financiera');
        Permission::generateFor('about-us','Sobre nosotros');
        Permission::generateFor('statics','Otras informaciones');
    }
}
