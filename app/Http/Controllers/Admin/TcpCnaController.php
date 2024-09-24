<?php

namespace App\Http\Controllers\Admin;

use App\Auth\GeneralServices;
use App\Http\Requests\StaticsTextUpdateRequest;
use App\Models\Services;
use App\Models\ServicesFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TcpCnaController extends Controller
{


    use GeneralServices;

    protected $redirectTo = 'admin.content.tcp-cna.index';
    protected $tipo = 'tcp-cna';
    public function __construct()
    {
        $this->middleware('hasPermission:tcp-cna.create')->only(['create','store']);
        $this->middleware('hasPermission:tcp-cna.destroy')->only(['destroy']);
        $this->middleware('hasPermission:tcp-cna.index')->only(['index']);
        $this->middleware('hasPermission:tcp-cna.edit')->only(['update','edit']);
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
