<?php

namespace App\Http\Controllers;

use App\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class BpaController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
