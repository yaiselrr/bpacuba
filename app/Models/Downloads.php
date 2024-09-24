<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Downloads extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;
    protected $fillable = [
        'titulo', 'descripcion','publica','fichero'
    ];
}
