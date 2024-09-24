<?php

namespace App\Http\Controllers;

use App\Models\BpaValoration;
use App\Models\SiteData;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $types = ['banca-electronica', 'banca-corporativa','banca-personal','tcp-cna'];
        $stadistics = array();
        $site = SiteData::first();
        foreach ($types as $key) {
                $element = $this->starsByType($key);
                $stadistics[] =$element;
        }
        return view('admin.dashboard',compact('stadistics','site'));
    }
    private function starsByType($type){
        $group = DB::table('bpa_valorations')
            ->select('estrellas', DB::raw('count(*) as num'))
            ->where('tipo',$type)
            ->groupBy('estrellas')
            ->get();
        $stars = [0,0,0,0,0];
        $obtain = 0;
        $total = BpaValoration::where('tipo',$type)->get()->count();
        foreach ($group as $star){
            if($star->estrellas > 0) {
                $obtain += $star->estrellas*$star->num;
                $stars[$star->estrellas - 1] = round($star->num * 100 / $total, 2);
            }
        }
        //REVIZAR
        if ($total>0)
            $total = ($obtain/($total*5))*5;
        return ['stars'=>$stars,'total'=>$total,'type'=>$type];
    }
}
