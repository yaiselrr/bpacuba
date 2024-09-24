<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;

trait PostSave
{
    public static function boot() {
        parent::boot();

// create a event to happen on updating
        static::updating(function($table)  {
            if (Auth::user()) {
                $table->created_by = Auth::user()->name;
            }
        });

// create a event to happen on deleting
//        static::deleting(function($table)  {
//            $table->deleted_by = Auth::user()->name;
//        });

// create a event to happen on saving
        static::saving(function($table)  {
            if (Auth::user()) {
                $table->created_by = Auth::user()->name;
            }
        });
    }
}
