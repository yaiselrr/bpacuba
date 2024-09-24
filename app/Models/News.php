<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;
    protected $fillable = [
        'titulo', 'descripcion', 'fuente','publica','imagen', 'fecha_publicacion'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_publicacion' => 'datetime',
    ];
}
