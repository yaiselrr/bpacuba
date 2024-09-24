<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\Atm;
use App\Models\Municipality;
use App\Models\Office;
use App\Models\OfficesType;
use App\Models\Province;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtmController extends Controller
{
    //
    public function index(Request $request)
    {
        $provinces = Province::all();
        $municipalities = [];
        $selectedp = null;
        $selectedm = null;
        $info = Statics::where('tipo','cajeros')->first();
        if(empty($request->all()))
        {
            $atms = Atm::orderBy('province_id')->orderBy('municipality_id')->paginate(10);
        }
        else{
            $atms = Atm::query();
            if ($request->filled('province')){
                $selectedp = $request->province;
                $municipalities = Municipality::where('province_id',$request->province)->get();
                $atms->where('province_id',$request->province);
            }
            if ($request->filled('municipality')){
                $selectedm = $request->municipality;
                $atms->where('municipality_id',$request->municipality);
            }
            $atms = $atms->orderBy('province_id')->orderBy('municipality_id')->paginate(10);
            $atms->appends($request->all());
        }
        return view('home.atms',compact('provinces',
            'municipalities','selectedm', 'selectedp','atms','info'));
    }
}
