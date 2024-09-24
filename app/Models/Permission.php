<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PostSave;

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public static function generateFor($table_name, $display)
    {
        self::firstOrCreate(['name' => $table_name.'.index', 'table_name' => $table_name, 'display_name'=> 'Navegar en '._($display)]);
//        self::firstOrCreate(['name' => $table_name.'.show', 'table_name' => $table_name, 'display_name'=> 'Ver detalles de '._($display)]);
        self::firstOrCreate(['name' => $table_name.'.edit', 'table_name' => $table_name, 'display_name'=> 'Editar '._($display)]);
        self::firstOrCreate(['name' => $table_name.'.create', 'table_name' => $table_name, 'display_name'=> 'Crear '._($display)]);
        self::firstOrCreate(['name' => $table_name.'.destroy', 'table_name' => $table_name, 'display_name'=> 'Eliminar '._($display)]);
    }

    public static function removeFrom($table_name)
    {
        self::where(['table_name' => $table_name])->delete();
    }
}