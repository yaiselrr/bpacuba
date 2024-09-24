<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //
    use PostSave;
    protected $fillable = ['titulo','codigo',
        'identificacion','direccion','telefono',
        'cajero','punto','offices_type_id',
        'province_id','municipality_id'];
    public function provincia(){
        return $this->belongsTo('App\Models\Province','province_id');
    }
    public function municipio(){
        return $this->belongsTo('App\Models\Municipality','municipality_id');
    }
    public function tipoOficina(){
        return $this->belongsTo('App\Models\OfficesType','offices_type_id');
    }
}

