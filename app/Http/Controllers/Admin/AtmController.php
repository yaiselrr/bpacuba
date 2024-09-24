<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\ATMRequest;
use App\Models\Atm;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('hasPermission:atms.create')->only(['create','store']);
        $this->middleware('hasPermission:atms.destroy')->only(['destroy']);
        $this->middleware('hasPermission:atms.index')->only(['index']);
        $this->middleware('hasPermission:atms.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $atms = Atm::latest()->paginate(5);
        return view('admin.atms.index', ['atms'=>$atms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $provinces= Province::all();
        return view('admin.atms.add',compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ATMRequest $request)
    {
        //
        $validated = $request->validated();
        Atm::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.atms.index')->with('success',__('bpa.add-content',['contenido'=>'Cajero']) );
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
    public function edit(Request $request,Atm $atm)
    {
        //
        $provinces = Province::all();
        $municipalities = Municipality::where('province_id',$atm->provincia->id)->get();
        return view('admin.atms.edit',['atm'=>$atm,'provinces'=>$provinces,
            'municipalities'=>$municipalities]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ATMRequest $request, Atm $atm)
    {
        //
        $validated = $request->validated();
        $atm->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.atms.index')->with('success',__('bpa.edit-content',['contenido'=>'Cajero']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Atm::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.atms.index')->with('success',__('bpa.delete-content',['contenido'=>'Cajero']));
    }
}
