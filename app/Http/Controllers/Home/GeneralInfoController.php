<?php

namespace App\Http\Controllers\Home;

use App\Models\GeneralInfo;
use App\Http\Controllers\Controller;

class GeneralInfoController extends Controller
{
    //
    public function index($info)
    {
        if(in_array($info, ['tasa_interes','tarifas-terminos', 'actividad-internacional','info-financiera'])) {
            $info = GeneralInfo::where('tipo',$info)->firstOrFail();
            return view('home.infos',compact('info'));
        }
        else return abort(404);
        //'banca-electronica', 'banca-corporativa','banca-personal','tcp-cna'
    }
}
