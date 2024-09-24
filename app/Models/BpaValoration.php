<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class BpaValoration extends Model
{
    //
    use PostSave;
    protected $fillable = ['estrellas','tipo'];
}
