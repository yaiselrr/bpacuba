<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InfoImages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='general_info_images';
    protected $fillable = [
        'imagen'
    ];

    public function info()
    {
        return $this->belongsTo('App\Models\GeneralInfo','info_id','info_id');
    }
}
