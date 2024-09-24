<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\ConsultsRequest;
use App\Models\Consult;
use App\Models\ContactInfo;
use App\Http\Controllers\Controller;
use App\Models\Sucursal;

class ContactController extends Controller
{
    //
    public function index()
    {
        $info = Sucursal::all();
        $central = ContactInfo::first();
        return view('home.contact',compact('info', 'central'));
    }
    public function store(ConsultsRequest $request)
    {
        //
        $validated = $request->validated();
        Consult::create($validated);
        return redirect()->route('home.contact')->with('success','Mensaje enviado con éxito');
    }
}
