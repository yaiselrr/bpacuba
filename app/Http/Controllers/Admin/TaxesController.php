<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Models\ChangeTax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:taxes.index')->only(['index']);
        $this->middleware('hasPermission:taxes.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $taxes = ChangeTax::latest()->paginate(5);
        return view('admin.taxes.index', ['taxes'=>$taxes]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,ChangeTax $tax)
    {
        //
        return view('admin.taxes.edit',['tax'=>$tax]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChangeTax $tax)
    {
        //
        $validated=$request->all();
        if($request->hasFile('imagen')){
            $old_file = $tax->imagen;
            $validated['imagen'] = $request->imagen->store('carrusel', 'public');
            $tax->update($validated);
            Storage::delete($old_file);

        }
        else{
            $tax->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.taxes.index')->with('success',__('bpa.edit-content',['contenido'=>'Tasas de cambio']));
    }

}
