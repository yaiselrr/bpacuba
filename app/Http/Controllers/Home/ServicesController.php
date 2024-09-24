<?php

namespace App\Http\Controllers\Home;

use App\Models\BpaValoration;
use App\Models\Services;
use App\Models\ServicesPages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;

class ServicesController extends Controller
{
    //
    private $session;

    public function __construct(Store $session)
    {
        // Let Laravel inject the session Store instance,
        // and assign it to our $session variable.
        $this->session = $session;
    }

    public function index($service)
    {
        if(in_array($service, ['banca-electronica', 'banca-corporativa','banca-personal','tcp-cna'])) {
            $service = Services::where('tipo',$service)->firstOrFail();
            $modal= true;
            if($this->session->exists('modal')){
                $this->session->forget('modal');
                $modal= false;
            }
            return view('home.services',compact('service','modal'));
        }
        else return abort(404);
        //'banca-electronica', 'banca-corporativa','banca-personal','tcp-cna'
    }
    public function page($service, $slug)
    {
        $service = Services::where('tipo',$service)->firstOrFail();
        $page = ServicesPages::where('slug',$slug)->where('services_id',$service->id)->firstOrFail();
        return view('home.pages',compact('page','service'));

    }
    public function store(Request $request)
    {
        BpaValoration::create(
                [
                    "estrellas"=> $request->get('valoracion'),
                    "tipo"=> $request->get('tipo')
                ]
            );
        $this->session->put('modal',true);
        return redirect()->route('home.service',$request->get('tipo'))->with('success','Valoración guardada con éxito');
    }
}
