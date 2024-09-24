<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class SiteData extends Model
{
    //
    use PostSave;

    protected $fillable=['visitas','actualizacion'];
}
