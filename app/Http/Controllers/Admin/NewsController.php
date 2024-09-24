<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:news.create')->only(['create','store']);
        $this->middleware('hasPermission:news.destroy')->only(['destroy']);
        $this->middleware('hasPermission:news.index')->only(['index']);
        $this->middleware('hasPermission:news.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $news = News::latest()->paginate(5);
        return view('admin.news.index', ['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['fecha_publicacion'] = now();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('imagen')){
            $validated['imagen'] = $request->imagen->store('noticias', 'public');
        }
        News::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.news.index')->with('success',__('bpa.add-content',['contenido'=>'Noticia']));
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
    public function edit(Request $request,News $news)
    {
        //
        return view('admin.news.edit',['news'=>$news]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        //
        $validated = $request->validated();
        $validated['publica'] = $request->filled('publica');
        if($request->hasFile('imagen')){
            $old_file = $news->imagen;
            $validated['imagen'] = $request->imagen->store('noticias', 'public');
            $news->update($validated);
            Storage::delete($old_file);

        }
        else{
            $news->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.news.index')->with('success',__('bpa.edit-content',['contenido'=>'Noticia']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.news.index')->with('success',__('bpa.delete-content',['contenido'=>'Noticia']));
    }
}
