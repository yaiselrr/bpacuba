<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    //
    use PostSave;
    protected $fillable = ['email','telefono',
        'province_id'];
    public function provincia(){
        return $this->belongsTo('App\Models\Province','province_id');
    }
}
