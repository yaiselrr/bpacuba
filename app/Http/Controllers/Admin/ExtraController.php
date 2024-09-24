<?php

namespace App\Http\Controllers\Admin;
use App\Models\Apps;
use App\Models\Atm;
use App\Models\Carousels;
use App\Models\ContactInfo;
use App\Models\Downloads;
use App\Models\Links;
use App\Models\Municipality;
use App\Models\Office;
use App\Models\RedSocial;
use App\Models\Staff;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExtraController extends Controller
{




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unique(Request $request)
    {
        //
        if ($request->ajax()) {
            $model = [];
            switch ($request->model) {
                case 'atm':
                    $model = Atm::where('codigo', $request->value)->get();
                    break;
                case 'office':
                    $model = Office::where('codigo', $request->value)->get();
                    break;
                case 'app':
                    $model = Apps::where('titulo', $request->value)->get();
                    break;
                case 'contact':
                    $model = ContactInfo::where('telefono', $request->value)->get();
                    break;
                case 'sucursal':
                    $model = Sucursal::where('telefono', $request->value)->get();
                    break;
                case 'download':
                    $model = Downloads::where('titulo', $request->value)->get();
                    break;
                case 'link':
                    $model = Links::where('url', $request->value)->get();
                    break;
                case 'carousel':
                    $model = Carousels::where('url', $request->value)->get();
                    break;
                case 'social':
                    $model = RedSocial::where('url', $request->value)->get();
                    break;
                case 'news':
                    $model = Links::where('titulo', $request->value)->get();
                    break;
                case 'staff':
                    $model = Staff::where('email', $request->value)->get();
                    break;
                case 'user':
                    $model = User::where('email', $request->value)->get();
                    break;
            }
            if ($request->has('id') && $request->filled('id')) {
                switch ($request->model) {
                    case 'atm':
                        $model = Atm::where('codigo', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'office':
                        $model = Office::where('codigo', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'app':
                        $model = Apps::where('titulo', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'contact':
                        $model = ContactInfo::where('telefono', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'sucursal':
                        $model = Sucursal::where('telefono', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'download':
                        $model = Apps::where('titulo', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'link':
                        $model = Links::where('url', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'carousel':
                        $model = Carousels::where('url', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'social':
                        $model = RedSocial::where('url', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'news':
                        $model = Links::where('titulo', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'staff':
                        $model = Staff::where('email', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                    case 'user':
                        $model = User::where('email', $request->value)->where('id', '<>', $request->id)->get();
                        break;
                }
            }
            return json_encode(sizeof($model) == 0);
        }
        return view('admin.dashboard');
    }

    public function municipalities(Request $request)
    {
        if($request->ajax()) {
            return Municipality::where('province_id', $request->id)->pluck('municipio', 'id');
        }
        return view('admin.dashboard');
    }
}
