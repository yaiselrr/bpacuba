<?php

namespace App\Http\Controllers\Admin;

use App\Auth\Info;
use App\Http\Controllers\Controller;

class InternationalController extends Controller
{


    use Info;

    protected $redirectTo = 'admin.content.international-activity.index';
    protected $tipo = 'actividad-internacional';

    public function __construct()
    {
        $this->middleware('hasPermission:international-activity.create')->only(['create','store']);
        $this->middleware('hasPermission:international-activity.destroy')->only(['destroy']);
        $this->middleware('hasPermission:international-activity.index')->only(['index']);
        $this->middleware('hasPermission:international-activity.edit')->only(['update','edit']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


}
