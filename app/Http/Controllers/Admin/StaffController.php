<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\StaffUpdateRequest;
use App\Http\Requests\StaffStoreRequest;
use App\Models\Ranks;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:staff.create')->only(['create','store']);
        $this->middleware('hasPermission:staff.destroy')->only(['destroy']);
        $this->middleware('hasPermission:staff.index')->only(['index']);
        $this->middleware('hasPermission:staff.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $staffs = Staff::latest()->paginate(5);
        return view('admin.staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $ranks = Ranks::all();
        return view('admin.staff.add',compact('ranks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffStoreRequest $request)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('foto')){
            $validated['foto'] = $request->foto->store('direccion', 'public');
        }
        Staff::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.staff.index')->with('success',__('bpa.add-content',['contenido'=>'Miembro']));
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
    public function edit(Request $request,Staff $staff)
    {
        //
        $ranks= Ranks::all();
        return view('admin.staff.edit',['staff'=>$staff,'ranks'=>$ranks]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffUpdateRequest $request, Staff $staff)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('foto')){
            $old_file = $staff->foto;
            $validated['foto'] = $request->foto->store('direccion', 'public');
            $staff->update($validated);
            Storage::delete($old_file);

        }
        else{
            $staff->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.staff.index')->with('success',__('bpa.edit-content',['contenido'=>'Miembro']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.staff.index')->with('success',__('bpa.delete-content',['contenido'=>'Miembro']));
    }
}
