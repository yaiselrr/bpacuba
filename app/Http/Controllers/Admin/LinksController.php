<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\LinksStoreRequest;
use App\Http\Requests\LinksUpdateRequest;
use App\Models\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:links.create')->only(['create','store']);
        $this->middleware('hasPermission:links.destroy')->only(['destroy']);
        $this->middleware('hasPermission:links.index')->only(['index']);
        $this->middleware('hasPermission:links.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $links = Links::latest()->paginate(5);
        return view('admin.links.index', ['links'=>$links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.links.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksStoreRequest $request)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('logo')){
            $validated['logo'] = $request->logo->store('enlaces', 'public');
        }
        Links::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.links.index')->with('success',__('bpa.add-content',['contenido'=>'Enlace']));
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
    public function edit(Request $request,Links $link)
    {
        //
        return view('admin.links.edit',['link'=>$link]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinksUpdateRequest $request, Links $link)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('logo')){
            $old_file = $link->logo;
            $validated['logo'] = $request->logo->store('enlaces', 'public');
            $link->update($validated);
            Storage::delete($old_file);

        }
        else{
            $link->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.links.index')->with('success',__('bpa.edit-content',['contenido'=>'Enlace']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Links::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.links.index')->with('success',__('bpa.delete-content',['contenido'=>'Enlace']));
    }
}
