<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Carousels extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;
    protected $table='carousel';
    protected $fillable = [
        'titulo','imagen','url'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
