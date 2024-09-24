<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\appsStoreRequest;
use App\Http\Requests\appsUpdateRequest;
use App\Models\Apps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AppsController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:apps.create')->only(['create','store']);
        $this->middleware('hasPermission:apps.destroy')->only(['destroy']);
        $this->middleware('hasPermission:apps.index')->only(['index']);
        $this->middleware('hasPermission:apps.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $apps = Apps::latest()->paginate(5);
        return view('admin.apps.index', ['apps'=>$apps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.apps.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppsStoreRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('fichero')){
            $validated['fichero'] = $request->fichero->store('apps', 'public');
        }
        if($request->hasFile('imagen')){
            $validated['imagen'] = $request->imagen->store('apps', 'public');
        }
        apps::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.apps.index')->with('success',__('bpa.add-content',['contenido'=>'Aplicaciones móviles']));
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
    public function edit(Request $request,Apps $app)
    {
        //
        return view('admin.apps.edit',['app'=>$app]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppsUpdateRequest $request, Apps $app)
    {
        //
        $validated = $request->validated();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('fichero')){
            $old_file = $app->fichero;
            $validated['fichero'] = $request->fichero->store('apps', 'public');
            $app->update($validated);
            Storage::delete($old_file);

        }
        if($request->hasFile('imagen')){
            $old_file = $app->imagen;
            $validated['imagen'] = $request->imagen->store('apps', 'public');
            $app->update($validated);
            Storage::delete($old_file);
        }
        else{
            $app->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.apps.index')->with('success',__('bpa.edit-content',['contenido'=>'Aplicaciones móviles']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        apps::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.apps.index')->with('success',__('bpa.delete-content',['contenido'=>'Aplicaciones móviles']));
    }
}
