<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\ProvincesRequest;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvincesController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:provinces.create')->only(['create','store']);
        $this->middleware('hasPermission:provinces.destroy')->only(['destroy']);
        $this->middleware('hasPermission:provinces.index')->only(['index']);
        $this->middleware('hasPermission:provinces.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $prov = Province::latest()->paginate(5);
        return view('admin.provinces.index', ['provinces'=>$prov]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.provinces.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvincesRequest $request)
    {
        //
        $validated = $request->validated();
        Province::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.provinces.index')->with('success',__('bpa.add-content',['contenido'=>'Provincia']));
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
    public function edit(Request $request,Province $province)
    {
        //
        return view('admin.provinces.edit',['province'=>$province]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvincesRequest $request, Province $province)
    {
        //
        $validated = $request->validated();
        $province->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.provinces.index')->with('success',__('bpa.edit-content',['contenido'=>'Provincia']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Province::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.provinces.index')->with('success',__('bpa.delete-content',['contenido'=>'Provincia']));
    }
}
