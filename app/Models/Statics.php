<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Statics extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;

    protected $table = 'site_descriptions';
    protected $fillable = [
        'home_text','descripcion','tipo'
    ];

}
