<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\DownloadsStoreRequest;
use App\Http\Requests\DownloadsUpdateRequest;
use App\Models\Downloads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:downloads.create')->only(['create','store']);
        $this->middleware('hasPermission:downloads.destroy')->only(['destroy']);
        $this->middleware('hasPermission:downloads.index')->only(['index']);
        $this->middleware('hasPermission:downloads.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $downloads = Downloads::latest()->paginate(5);
        return view('admin.downloads.index', ['downloads'=>$downloads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.downloads.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DownloadsStoreRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('fichero')){
            $validated['fichero'] = $request->fichero->store('downloads', 'public');
        }
        Downloads::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.downloads.index')->with('success',__('bpa.add-content',['contenido'=>'Descarga']));
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
    public function edit(Request $request,Downloads $download)
    {
        //
        return view('admin.downloads.edit',['download'=>$download]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DownloadsUpdateRequest $request, Downloads $download)
    {
        //
        $validated = $request->validated();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('imagen')){
            $old_file = $download->fichero;
            $validated['imagen'] = $request->fichero->store('downloads', 'public');
            $download->update($validated);
            Storage::delete($old_file);

        }
        else{
            $download->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.downloads.index')->with('success',__('bpa.edit-content',['contenido'=>'Descarga']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Downloads::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.downloads.index')->with('success',__('bpa.delete-content',['contenido'=>'Descarga']));
    }
}
