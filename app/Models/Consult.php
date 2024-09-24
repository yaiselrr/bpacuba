<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    //
    use PostSave;

    protected $fillable = ['mensaje','nombre','email'];
}
