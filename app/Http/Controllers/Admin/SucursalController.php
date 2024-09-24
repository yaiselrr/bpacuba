<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\OfficeRequest;
use App\Http\Requests\SucursalRequest;
use App\Models\Municipality;
use App\Models\Office;
use App\Models\Province;
use App\Models\OfficesType;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SucursalController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:sucursal.create')->only(['create','store']);
        $this->middleware('hasPermission:sucursal.destroy')->only(['destroy']);
        $this->middleware('hasPermission:sucursal.index')->only(['index']);
        $this->middleware('hasPermission:sucursal.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $sucursales = Sucursal::latest()->paginate(5);
        return view('admin.sucursal.index', ['sucursales'=>$sucursales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $provinces= Province::all();
        return view('admin.sucursal.add',compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalRequest $request)
    {
        //
        $validated = $request->validated();
        Sucursal::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.sucursal.index')->with('success',__('bpa.add-content',['contenido'=>'Contacto de sucursal']));
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
    public function edit(Request $request,Sucursal $sucursal)
    {
        //
        $provinces = Province::all();
        return view('admin.sucursal.edit',compact('sucursal','provinces'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalRequest $request, Sucursal $sucursal)
    {
        //
        $validated = $request->validated();
        $sucursal->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.sucursal.index')->with('success',__('bpa.edit-content',['contenido'=>'Contacto de sucursal']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sucursal::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.sucursal.index')->with('success',__('bpa.delete-content',['contenido'=>'contactos de sucursal']));
    }
}
