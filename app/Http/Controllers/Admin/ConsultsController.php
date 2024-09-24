<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\ConsultsRequest;
use App\Http\Requests\RanksRequest;
use App\Models\Consult;
use App\Models\Ranks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:consults.create')->only(['create','store']);
        $this->middleware('hasPermission:consults.destroy')->only(['destroy']);
        $this->middleware('hasPermission:consults.index')->only(['index']);
        $this->middleware('hasPermission:consults.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $consults = Consult::latest()->paginate(5);
        return view('admin.consults.index', compact('consults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.consults.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultsRequest $request)
    {
        //
        $validated = $request->validated();
        Consult::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.consults.index')->with('success',__('bpa.add-content',['contenido'=>'Consulta']));
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
    public function edit(Request $request,Consult $consult)
    {
        //
        return view('admin.consults.edit',compact('consult'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultsRequest $request, Consult $consult)
    {
        //
        $validated = $request->validated();
        $consult->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.consults.index')->with('success',__('bpa.edit-content',['contenido'=>'Consulta']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consult::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.consults.index')->with('success',__('bpa.delete-content',['contenido'=>'Consulta']));
    }
}
