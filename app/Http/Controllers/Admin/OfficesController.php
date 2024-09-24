<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\OfficeRequest;
use App\Models\Municipality;
use App\Models\Office;
use App\Models\Province;
use App\Models\OfficesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficesController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:offices.create')->only(['create','store']);
        $this->middleware('hasPermission:offices.destroy')->only(['destroy']);
        $this->middleware('hasPermission:offices.index')->only(['index']);
        $this->middleware('hasPermission:offices.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $offices = Office::latest()->paginate(5);
        return view('admin.offices.index', ['offices'=>$offices]);
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
        $typeOffices= OfficesType::all();
        return view('admin.offices.add',compact('provinces','typeOffices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        //
        $validated = $request->validated();
        Office::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.offices.index')->with('success',__('bpa.add-content',['contenido'=>'Oficina']));
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
    public function edit(Request $request,Office $office)
    {
        //
        $provinces = Province::all();
        $typeOffices = OfficesType::all();
        $municipalities = Municipality::where('province_id',$office->provincia->id)->get();
        return view('admin.offices.edit',compact('office','provinces',
            'municipalities','typeOffices'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, Office $office)
    {
        //
        $validated = $request->validated();
        $office->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.offices.index')->with('success',__('bpa.edit-content',['contenido'=>'Oficina']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Office::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.offices.index')->with('success',__('bpa.delete-content',['contenido'=>'Oficina']));
    }
}
