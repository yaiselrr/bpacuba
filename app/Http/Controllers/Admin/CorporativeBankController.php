<?php

namespace App\Http\Controllers\Admin;

use App\Auth\GeneralServices;
use App\Http\Requests\StaticsTextUpdateRequest;
use App\Models\Services;
use App\Models\ServicesFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CorporativeBankController extends Controller
{


    use GeneralServices;

    protected $redirectTo = 'admin.content.corporative-bank.index';
    protected $tipo = 'banca-corporativa';

    public function __construct()
    {
        $this->middleware('hasPermission:corporative-bank.create')->only(['create','store']);
        $this->middleware('hasPermission:corporative-bank.destroy')->only(['destroy']);
        $this->middleware('hasPermission:corporative-bank.index')->only(['index']);
        $this->middleware('hasPermission:corporative-bank.edit')->only(['update','edit']);
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
