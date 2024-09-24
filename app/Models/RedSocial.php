<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    //
    use PostSave;

    protected $fillable = [
        'titulo','url', 'red_social'
    ];

    public function red(){
        return $this->belongsTo('App\Models\Social','red_social');
    }
}
