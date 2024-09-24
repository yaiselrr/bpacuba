<?php

namespace App\Auth;

use App\Events\UpdatedSite;
use App\Models\GeneralInfo;
use App\Models\InfoImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
trait Info
{
    public function index(Request $request){
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo) {
            $infos = GeneralInfo::where('tipo', $tipo)->get();
            return view('admin.info.index', compact('infos','tipo'));
        }
        else return abort(404);
    }

    public function edit(Request $request,$id)
    {
        //
        $info=GeneralInfo::findOrfail($id);
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo == $info->tipo) {
            if($tipo === 'tarifas-terminos'){
                return view('admin.info.editex', ['info' => $info]);
            }
            else
                return view('admin.info.edit', ['info' => $info]);
        }
        else return abort(404);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info = GeneralInfo::findOrfail($id);
        $validated = $request->all();
        $info->update($validated);
        //Actualizar
        foreach ($request->id as $key){
            $file = InfoImages::findOrFail($key);
            $old_file = $file->fichero;
            if($request->has('imagen') && $request->hasFile('imagen.'.($key))){
                $file->imagen = $request->imagen[$key]->store('info', 'public');
                $file->save();
                Storage::delete($old_file);
            }
            else{
                $file->save();
            }
        }
        $redirect = property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
        $key = 'bpa.'.$info->tipo;
        $tran =trans($key);
        event(new UpdatedSite());
        return redirect()->route($redirect)->with('success', __('bpa.edit-content',['contenido'=>$tran]));
    }
}
