<?php

namespace App\Http\Controllers\Admin;

use App\Auth\Info;
use App\Http\Controllers\Controller;

class InteresController extends Controller
{


    use Info;

    protected $redirectTo = 'admin.content.interes.index';
    protected $tipo = 'tasa_interes';

    public function __construct()
    {
        $this->middleware('hasPermission:interes.create')->only(['create','store']);
        $this->middleware('hasPermission:interes.destroy')->only(['destroy']);
        $this->middleware('hasPermission:interes.index')->only(['index']);
        $this->middleware('hasPermission:interes.edit')->only(['update','edit']);
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
