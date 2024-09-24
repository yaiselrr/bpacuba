<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\ContactsRequest;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
//        $this->middleware('hasPermission:contacts.create')->only(['create','store']);
//        $this->middleware('hasPermission:contacts.destroy')->only(['destroy']);
        $this->middleware('hasPermission:contacts.index')->only(['index']);
        $this->middleware('hasPermission:contacts.edit')->only(['update','edit']);
    }
    public function index(Request $request)
    {
        //
        $contacts = ContactInfo::latest()->paginate(5);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create(Request $request)
//    {
//        //
//        return view('admin.contacts.add');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(ContactsRequest $request)
//    {
//        //
//        $validated = $request->validated();
//        $validated['central'] = $request->filled('central');
//        ContactInfo::create($validated);
//        event(new UpdatedSite());
//        return redirect()->route('admin.content.contacts.index')->with('success',__('bpa.add-content',['contenido'=>'Contacto']));
//    }

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
    public function edit(Request $request,ContactInfo $contact)
    {
        //
        return view('admin.contacts.edit',['contact'=>$contact]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactsRequest $request, ContactInfo $contact)
    {
        //
        $validated = $request->validated();
//        $validated['central'] = $request->filled('central');
        if($request->hasFile('imagen')){
            $old_file = $contact->imagen;
            $validated['imagen'] = $request->imagen->store('contacts', 'public');
            $contact->update($validated);
            Storage::delete($old_file);

        }
        else{
            $contact->update($validated);
        }
        event(new UpdatedSite());
        return redirect()->route('admin.content.contacts.index')->with('success',__('bpa.edit-content',['contenido'=>'Contacto de Oficina Central']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        ContactInfo::destroy($id);
//        event(new UpdatedSite());
//        return redirect()->route('admin.content.contacts.index')->with('success',__('bpa.delete-content',['contenido'=>'Contacto']));
//    }
}
