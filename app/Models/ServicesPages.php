<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServicesPages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;

    protected $fillable = [
        'descripcion','titulo', 'slug', 'services_id'
    ];

    public function ficheros()
    {
        return $this->hasMany('App\Models\ServicesFiles','pages_id','id');
    }

    public function servicio()
    {
        return $this->belongsTo('App\Models\Services','services_id');
    }
}
