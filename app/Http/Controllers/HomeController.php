<?php

namespace App\Http\Controllers;

use App\Events\VisitorsCounter;
use App\Http\Middleware\Visitors;
use App\Models\Carousels;
use App\Models\ChangeTax;
use App\Models\Apps;
use App\Models\GeneralInfo;
use App\Models\Links;
use App\Models\News;
use App\Models\Services;
use App\Models\SiteData;
use App\Models\Statics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        'generales', 'descargas',
//                                'redes-oficinas', 'tarifas-terminos',
//                                'cajeros','productos-servicios'
        $carrousel = Carousels::all();
        $tasaCambio = ChangeTax::first();
        $enlaces = Links::all();
        $tasaInteres = GeneralInfo::where('tipo','tasa_interes')->firstOrfail();
        $services = Services::all();
        $productos = Statics::where('tipo','productos-servicios')->firstOrfail();
        $news = News::where('publica',true)->orderBy('fecha_publicacion', 'desc')->take(3)->get();
        $apps = Apps::where('publica',true)->take(3)->get();
        event(new VisitorsCounter());
        $footer = SiteData::first();
        return view('home',compact('carrousel',
            'tasaInteres',
            'productos','services','apps',
            'news','tasaCambio','enlaces','footer'));
    }
}
