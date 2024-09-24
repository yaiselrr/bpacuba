<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use PostSave;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'questions_answers';
    protected $fillable = [
        'pregunta', 'respuesta'
    ];
}
