<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Models\Services;
use App\Models\ServicesFiles;
use App\Models\ServicesPages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:pages.create')->only(['create','store']);
        $this->middleware('hasPermission:pages.destroy')->only(['destroy']);
        $this->middleware('hasPermission:pages.index')->only(['index']);
        $this->middleware('hasPermission:pages.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $pages = ServicesPages::latest()->paginate(5);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $tipos = Services::all();
        return view('admin.pages.add', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->all();
        $validated['slug'] = Str::slug($request->get('titulo'));
        $page = ServicesPages::create($validated);
        if($request->has('new_nombre')){
            foreach ($request->new_nombre as $key=>$v){
                $new_file = $request->new_fichero[$key]->store('services', 'public');
                ServicesFiles::create(
                    [
                        'nombre'=>$request->new_nombre[$key],
                        'fichero'=> $new_file,
                        'pages_id'=>$page->id
                    ]
                );
            }
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.pages.index')->with('success',__('bpa.add-content',['contenido'=>'Páginas internas']) );
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
    public function edit(Request $request,ServicesPages $page)
    {
        //
        $tipos = Services::all();
        return view('admin.pages.edit',compact('page', 'tipos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicesPages $page)
    {
        //
        $validated = $request->all();
        $validated['slug'] = Str::slug($request->get('titulo'));
        $page->updated($validated);
        //Borrar ficheros
        $service_files = $page->ficheros;
        if ($service_files) {
            if($request->id)
                $delete_files = $service_files->diff(ServicesFiles::whereIn('id', $request->id)->get());
            else
                $delete_files = $service_files;
            foreach ($delete_files as $file) {
                Storage::delete($file->fichero);
            }

            ServicesFiles::whereIn('id', $delete_files->modelKeys())->delete();
        }
        //Actualizar
        if($request->id) {
            foreach ($request->id as $key) {
                $file = ServicesFiles::findOrFail($key);
                $file->nombre = $request->nombre[$key];
                $old_file = $file->fichero;
                if ($request->has('fichero') && $request->hasFile('fichero.' . ($key))) {
                    $file->fichero = $request->fichero[$key]->store('services', 'public');
                    $file->save();
                    Storage::delete($old_file);
                } else {
                    $file->save();
                }
            }
        }
        if($request->has('new_nombre')){
            foreach ($request->new_nombre as $key=>$v){
                $new_file = $request->new_fichero[$key]->store('services', 'public');
                ServicesFiles::create(
                    [
                        'nombre'=>$request->new_nombre[$key],
                        'fichero'=> $new_file,
                        'pages_id'=>$page->id
                    ]
                );
            }
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.pages.index')->with('success',__('bpa.edit-content',['contenido'=>'Páginas internas']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServicesPages::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.pages.index')->with('success',__('bpa.delete-content',['contenido'=>'Páginas internas']));
    }
}
