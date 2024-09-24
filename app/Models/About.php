<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use PostSave;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'about_us';
    protected $fillable = [
        'objetivos', 'mision','vision'
    ];
}
