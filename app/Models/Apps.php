<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    use PostSave;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'descripcion','publica','fichero','imagen'
    ];
}
