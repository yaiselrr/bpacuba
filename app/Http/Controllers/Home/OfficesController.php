<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\Municipality;
use App\Models\Office;
use App\Models\OfficesType;
use App\Models\Province;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficesController extends Controller
{
    //
    public function index(Request $request)
    {
        $provinces = Province::all();
        $types = OfficesType::all();
        $municipalities = [];
        $selectedp = null;
        $selectedt = null;
        $selectedm = null;
        $info = Statics::where('tipo','redes-oficinas')->first();
        if(empty($request->all()))
        {
            $offices = Office::orderBy('province_id')->orderBy('municipality_id')->paginate(10);
        }
        else{
            $offices = Office::query();
            if ($request->filled('province')){
                $selectedp = $request->province;
                $municipalities = Municipality::where('province_id',$request->province)->get();
                $offices->where('province_id',$request->province);
            }
            if ($request->filled('municipality')){
                $selectedm = $request->municipality;
                $offices->where('municipality_id',$request->municipality);
            }
            if ($request->filled('officeType')){
                $selectedt= $request->officeType;
                $offices->where('offices_type_id',$request->officeType);
            }
            $offices = $offices->orderBy('province_id')->orderBy('municipality_id')->paginate(10);
            $offices->appends($request->all());
        }
        return view('home.offices',compact('provinces',
            'municipalities','selectedm','selectedt', 'selectedp','offices','types','info'));
    }
}
