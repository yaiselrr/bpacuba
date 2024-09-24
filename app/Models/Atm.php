<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Atm extends Model
{
    //
    use PostSave;

    protected $fillable = [
        'titulo','referencia','direccion','codigo','municipality_id','province_id'
    ];
    public function provincia(){
        return $this->belongsTo('App\Models\Province','province_id');
    }
    public function municipio(){
        return $this->belongsTo('App\Models\Municipality','municipality_id');
    }
}
