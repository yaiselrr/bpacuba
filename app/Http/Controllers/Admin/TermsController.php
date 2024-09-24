<?php

namespace App\Http\Controllers\Admin;

use App\Auth\Info;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{


    use Info;

    protected $redirectTo = 'admin.content.interes.index';
    protected $tipo = 'tarifas-terminos';

    public function __construct()
    {
        $this->middleware('hasPermission:terms.create')->only(['create','store']);
        $this->middleware('hasPermission:terms.destroy')->only(['destroy']);
        $this->middleware('hasPermission:terms.index')->only(['index']);
        $this->middleware('hasPermission:terms.edit')->only(['update','edit']);
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
