<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    use PostSave;

    protected $table = 'staff';
    protected $fillable = [
        'nombre','apellido','foto','email','telefono','rank_id'
    ];
    public function cargo(){
        return $this->belongsTo('App\Models\Ranks','rank_id');
    }
}
