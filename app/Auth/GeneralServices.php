<?php

namespace App\Auth;

use App\Events\UpdatedSite;
use App\Models\Services;
use App\Models\ServicesFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
trait GeneralServices
{
    public function index(Request $request){
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo) {

            $services = Services::where('tipo', $tipo)->get();
            return view('admin.services.index', compact('services','tipo'));
        }
        else return abort(404);
    }

    public function edit(Request $request,$service)
    {
        //
        $service=Services::findOrfail($service);
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo == $service->tipo)
            return view('admin.services.edit',['service'=>$service]);
        else return abort(404);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service)
    {
        $service = Services::findOrfail($service);
        $validated = $request->all();
        if($request->hasFile('imagen')){
            $old_file = $service->imagen;
            $validated['imagen'] = $request->imagen->store('services', 'public');
            $service->update($validated);
            Storage::delete($old_file);

        }
        else{
            $service->update($validated);
        }
        $redirect = property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
        $key = 'bpa.'.$service->tipo;
        $tran =trans($key);
        event(new UpdatedSite());
        return redirect()->route($redirect)->with('success', __('bpa.edit-content',['contenido'=>$tran]));
    }
}
