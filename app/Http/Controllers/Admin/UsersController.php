<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:users.create')->only(['create','store']);
        $this->middleware('hasPermission:users.destroy')->only(['destroy']);
        $this->middleware('hasPermission:users.index')->only(['index']);
        $this->middleware('hasPermission:users.edit')->only(['update','editPassword','updatePassword','edit']);
    }
    public function index(Request $request)
    {
        //
        $users=User::latest()->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //
        $input = $request->validated();
        $input['password'] = bcrypt($request->password);
        if($request->hasFile('avatar')){
            $input['avatar'] = $request->avatar->store('avatar', 'public');
        }
        User::create($input);
        return redirect()->route('admin.manager.users.index')->with('success',__('bpa.add-content',['contenido'=>'Usuario']));
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
    public function edit(Request $request,User $user)
    {
        //
        $roles=Role::all();
        return view('admin.users.edit',compact('user','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword(Request $request,User $user)
    {
        //
        return view('admin.users.password',compact('user'));

    }
    public function updatePassword(Request $request, User $user){
        $input['password'] = bcrypt($request->password);
        $user->update($input);
        return redirect()->route('admin.manager.users.index')->with('success','Contraseña editada satisfactoriamente');
    }
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $validated = $request->validated();
        if($request->hasFile('avatar')){
            $old_file = $user->avatar;
            $validated['avatar'] = $request->avatar->store('users', 'public');
            $user->update($validated);
            if($old_file){
                Storage::delete($old_file);
            }
        }
        else{
            $user->update($validated);
        }
        return redirect()->route('admin.manager.users.index')->with('success',__('bpa.edit-content',['contenido'=>'Usuario']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.manager.users.index')->with('success',__('bpa.delete-content',['contenido'=>'Usuario']));
    }
}
