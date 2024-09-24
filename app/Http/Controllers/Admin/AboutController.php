<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasPermission:about-us.create')->only(['create','store']);
        $this->middleware('hasPermission:about-us.destroy')->only(['destroy']);
        $this->middleware('hasPermission:about-us.index')->only(['index']);
        $this->middleware('hasPermission:about-us.edit')->only(['update','edit']);
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
    public function index(Request $request)
    {
        //
        $about=About::all();
        return view('admin.about.index',compact('about'));

    }

    public function edit(Request $request, About $about_us)
    {
        //
        return view('admin.about.edit',['about'=>$about_us]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $about_us)
    {
        //
        $validated = $request->validated();
        $about_us->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.about-us.index')->with('success',__('bpa.edit-content',['contenido'=>'Sobre nosotros']));
    }

}
