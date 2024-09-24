<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\MunicipalitiesRequest;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MunicipalitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:municipalities.create')->only(['create','store']);
        $this->middleware('hasPermission:municipalities.destroy')->only(['destroy']);
        $this->middleware('hasPermission:municipalities.index')->only(['index']);
        $this->middleware('hasPermission:municipalities.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $mun = Municipality::latest()->paginate(5);
        return view('admin.municipalities.index', ['municipalities'=>$mun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $provinces = Province::all();
        return view('admin.municipalities.add',['provinces'=>$provinces]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipalitiesRequest $request)
    {
        //
        $validated = $request->validated();
        Municipality::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.municipalities.index')->with('success',__('bpa.add-content',['contenido'=>'Municipio']));
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
    public function edit(Request $request,Municipality $municipality)
    {
        //
        $provinces = Province::all();
        return view('admin.municipalities.edit',['municipality'=>$municipality,'provinces'=>$provinces]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipalitiesRequest $request, Municipality $municipality)
    {
        //
        $validated = $request->validated();
        $municipality->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.municipalities.index')->with('success',__('bpa.edit-content',['contenido'=>'Muicipio']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Municipality::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.municipalities.index')->with('success',__('bpa.delete-content',['contenido'=>'Municipio']));
    }
}
