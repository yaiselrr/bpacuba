<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use PostSave;

    protected $guarded = [];
    protected $fillable = ['name'];
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission',
            'permission_role','role_id','permission_id');
    }
}
