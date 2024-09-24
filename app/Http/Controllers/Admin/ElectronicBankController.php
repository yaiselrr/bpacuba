<?php

namespace App\Http\Controllers\Admin;

use App\Auth\GeneralServices;
use App\Http\Requests\StaticsTextUpdateRequest;
use App\Models\Services;
use App\Models\ServicesFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ElectronicBankController extends Controller
{


    use GeneralServices;

    protected $redirectTo = 'admin.content.electronic-bank.index';
    protected $tipo = 'banca-electronica';

    public function __construct()
    {
        $this->middleware('hasPermission:electronic-bank.create')->only(['create','store']);
        $this->middleware('hasPermission:electronic-bank.destroy')->only(['destroy']);
        $this->middleware('hasPermission:electronic-bank.index')->only(['index']);
        $this->middleware('hasPermission:electronic-bank.edit')->only(['update','edit']);
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
