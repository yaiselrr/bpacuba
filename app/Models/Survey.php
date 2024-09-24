<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    use PostSave;

    protected $table='survey';

    protected $fillable = ['estrellas','sugerencias'];
}
