<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    use PostSave;

    protected $fillable = [
        'provincia'
    ];
    public function municipios(){
        return $this->hasMany('App\Models\Municipality');
    }
}
