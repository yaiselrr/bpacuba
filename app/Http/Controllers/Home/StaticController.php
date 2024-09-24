<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\ContactInfo;
use App\Models\Staff;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    //
    public function notes()
    {
        $notes = Statics::where('tipo','generales')->firstOrfail();
        return view('home.notes',compact('notes'));
    }
}
