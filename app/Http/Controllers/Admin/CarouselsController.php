<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\CarouselsUpdateRequest;
use App\Http\Requests\CarouselsStoreRequest;
use App\Models\Carousels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CarouselsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:carousels.create')->only(['create','store']);
        $this->middleware('hasPermission:carousels.destroy')->only(['destroy']);
        $this->middleware('hasPermission:carousels.index')->only(['index']);
        $this->middleware('hasPermission:carousels.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $carousels = Carousels::latest()->paginate(5);
        return view('admin.carousels.index', ['carousels'=>$carousels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.carousels.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselsStoreRequest $request)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('imagen')){
            $validated['imagen'] = $request->imagen->store('carrusel', 'public');
        }
        Carousels::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.carousels.index')->with('success',__('bpa.add-content',['contenido'=>'Carrusel']));
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
    public function edit(Request $request,Carousels $carousel)
    {
        //
        return view('admin.carousels.edit',['carousel'=>$carousel]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselsUpdateRequest $request, Carousels $carousel)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('imagen')){
            $old_file = $carousel->imagen;
            $validated['imagen'] = $request->imagen->store('carrusel', 'public');
            $carousel->update($validated);
            Storage::delete($old_file);

        }
        else{
            $carousel->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.carousels.index')->with('success',__('bpa.edit-content',['contenido'=>'Carrusel']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Carousels::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.carousels.index')->with('success',__('bpa.delete-content',['contenido'=>'Carrusel']));
    }
}
