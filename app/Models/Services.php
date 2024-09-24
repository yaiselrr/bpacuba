<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Services extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;

    protected $fillable = [
        'descripcion','imagen','valoracion'
    ];

    public function paginas()
    {
        return $this->hasMany('App\Models\ServicesPages','services_id');
    }
}
