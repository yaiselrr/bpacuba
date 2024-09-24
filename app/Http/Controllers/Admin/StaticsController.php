<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\StaticsTextUpdateRequest;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:statics.create')->only(['create','store']);
        $this->middleware('hasPermission:statics.destroy')->only(['destroy']);
        $this->middleware('hasPermission:statics.index')->only(['index']);
        $this->middleware('hasPermission:statics.edit')->only(['update','edit']);
    }

    public function index(Request $request)
    {
        //
        $statics=Statics::all();
        return view('admin.statics.index',['statics'=>$statics]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$tipo)
    {
        //
        $static=Statics::where('tipo', $tipo)->firstOrFail();
        return view('admin.statics.edit',['static'=>$static]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaticsTextUpdateRequest $request, Statics $static)
    {
        //
        $validated = $request->validated();
        $static->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.statics.index')->with('success',__('bpa.edit-content',['contenido'=>__('bpa.'.$static->tipo)]));
    }

}
