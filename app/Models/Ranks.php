<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;

    protected $table = 'rank';
    protected $fillable = [
        'cargo'
    ];
}
