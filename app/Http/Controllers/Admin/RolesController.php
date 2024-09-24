<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RanksRequest;
use App\Models\Permission;
use App\Models\Ranks;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:roles.create')->only(['create','store']);
        $this->middleware('hasPermission:roles.destroy')->only(['destroy']);
        $this->middleware('hasPermission:roles.index')->only(['index']);
        $this->middleware('hasPermission:roles.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $roles = Role::latest()->paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $permisos=Permission::all();
        return view('admin.roles.add',compact('permisos'));
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
        $role=Role::create($validated);
        $role->permissions()->attach($request->permisos);
        return redirect()->route('admin.manager.roles.index')->with('success',__('bpa.add-content',['contenido'=>'Rol']));
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
    public function edit(Request $request,Role $role)
    {
        //
        $permisos= Permission::all();
        $role->permisos = $role->permissions()->get()->modelKeys();
        return view('admin.roles.edit',compact('role','permisos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $validated = $request->all();
        $role->update($validated);
        $role->permissions()->detach();
        $role->permissions()->attach($request->permisos);
        return redirect()->route('admin.manager.roles.index')->with('success',__('bpa.edit-content',['contenido'=>'Rol']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('admin.manager.role.index')->with('success',__('bpa.delete-content',['contenido'=>'Rol']));
    }
}
