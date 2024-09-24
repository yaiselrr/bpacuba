<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\RanksRequest;
use App\Models\Ranks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:ranks.create')->only(['create','store']);
        $this->middleware('hasPermission:ranks.destroy')->only(['destroy']);
        $this->middleware('hasPermission:ranks.index')->only(['index']);
        $this->middleware('hasPermission:ranks.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $ranks = Ranks::latest()->paginate(5);
        return view('admin.ranks.index', ['ranks'=>$ranks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.ranks.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RanksRequest $request)
    {
        //
        $validated = $request->validated();
        Ranks::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.ranks.index')->with('success',__('bpa.add-content',['contenido'=>'Cargo']));
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
    public function edit(Request $request,Ranks $rank)
    {
        //
        return view('admin.ranks.edit',['rank'=>$rank]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RanksRequest $request, Ranks $rank)
    {
        //
        $validated = $request->validated();
        $rank->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.ranks.index')->with('success',__('bpa.edit-content',['contenido'=>'Cargo']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ranks::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.nomenclator.ranks.index')->with('success',__('bpa.delete-content',['contenido'=>'Cargo']));
    }
}
