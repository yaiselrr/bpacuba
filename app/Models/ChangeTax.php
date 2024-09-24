<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class ChangeTax extends Model
{
    //
    use PostSave;
    protected $fillable = ['imagen'];
}
