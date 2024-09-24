<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    //
    use PostSave;
    protected $fillable = ['titulo','direccion','telefono','email','imagen','descripcion'];
}
