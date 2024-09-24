<?php

namespace App\Http\Controllers\Admin;

use App\Auth\Info;
use App\Http\Controllers\Controller;

class FinancesController extends Controller
{


    use Info;

    protected $redirectTo = 'admin.content.finances-info.index';
    protected $tipo = 'info-financiera';

    public function __construct()
    {
        $this->middleware('hasPermission:finances-info.create')->only(['create','store']);
        $this->middleware('hasPermission:finances-info.destroy')->only(['destroy']);
        $this->middleware('hasPermission:finances-info.index')->only(['index']);
        $this->middleware('hasPermission:finances-info.edit')->only(['update','edit']);
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
