<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\OfficesTypeRequest;
use App\Models\OfficesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficesTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:type-offices.create')->only(['create','store']);
        $this->middleware('hasPermission:type-offices.destroy')->only(['destroy']);
        $this->middleware('hasPermission:type-offices.index')->only(['index']);
        $this->middleware('hasPermission:type-offices.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $offices_type = OfficesType::latest()->paginate(5);
        return view('admin.offices_type.index', ['offices_type'=>$offices_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.offices_type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficesTypeRequest $request)
    {
        //
        $validated = $request->validated();
        OfficesType::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.type-offices.index')->with('success',__('bpa.add-content',['contenido'=>'Tipo de oficina']));
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
    public function edit(Request $request,OfficesType $type_office)
    {
        //
        return view('admin.offices_type.edit',['office_type'=>$type_office]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficesTypeRequest $request, OfficesType $type_office)
    {
        //
        $validated = $request->validated();
        $type_office->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.type-offices.index')->with('success',__('bpa.edit-content',['contenido'=>'Tipo de oficina']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OfficesType::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.type-offices.index')->with('success',__('bpa.delete-content',['contenido'=>'Tipo de oficina']));
    }
}
