<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    use PostSave;

    protected $fillable = ['clase', 'red'];
}
