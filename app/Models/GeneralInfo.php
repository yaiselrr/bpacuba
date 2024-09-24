<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GeneralInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;
    protected $table='general_info';
    protected $fillable = [
        'descripcion','home_text'
    ];

    public function imagenes()
    {
        return $this->hasMany('App\Models\InfoImages', 'info_id');
    }
}
