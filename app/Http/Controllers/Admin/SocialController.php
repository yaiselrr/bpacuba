<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\SocialRequest;
use App\Models\RedSocial;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:socials.create')->only(['create','store']);
        $this->middleware('hasPermission:socials.destroy')->only(['destroy']);
        $this->middleware('hasPermission:socials.index')->only(['index']);
        $this->middleware('hasPermission:socials.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $socials = RedSocial::latest()->paginate(5);
        return view('admin.socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $redes = Social::all();
        return view('admin.socials.add',compact('redes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialRequest $request)
    {
        //
        $validated = $request->validated();
        RedSocial::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.socials.index')->with('success',__('bpa.add-content',['contenido'=>'Red social']));
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
    public function edit(Request $request,RedSocial $social)
    {
        //
        $redes = Social::all();
        return view('admin.socials.edit',['social'=>$social,'redes'=>$redes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialRequest $request, RedSocial $social)
    {
        //
        $validated = $request->validated();
        $social->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.socials.index')->with('success',__('bpa.edit-content',['contenido'=>'Red social']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RedSocial::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.socials.index')->with('success',__('bpa.delete-content',['contenido'=>'Red social']));
    }
}
