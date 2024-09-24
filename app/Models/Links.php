<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use PostSave;
    protected $table = 'links';
    protected $fillable = [
        'url', 'titulo','logo'
    ];
}
