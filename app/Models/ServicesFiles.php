<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesFiles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fichero', 'nombre','pages_id'
    ];
    protected $table = 'services_files';

    public function pagina()
    {
        return $this->belongsTo('Apps\Models\ServicesPages', 'pages_id');
    }
}
