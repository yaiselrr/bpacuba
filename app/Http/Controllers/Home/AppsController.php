<?php

namespace App\Http\Controllers\Home;

use App\Models\Apps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppsController extends Controller
{
    //
    public function index(Request $request)
    {
        $apps = Apps::where('publica', true)->orderBy('updated_at')->paginate(10);
        return view('home.apps',compact('apps'));
    }
}
