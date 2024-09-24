<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\ContactInfo;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    //
    public function index()
    {
        $about = About::firstOrfail();
        $staff = Staff::all();
        return view('home.about',compact('about','staff'));
    }
}
