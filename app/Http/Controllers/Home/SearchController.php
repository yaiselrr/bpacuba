<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\Apps;
use App\Models\Atm;
use App\Models\Downloads;
use App\Models\Municipality;
use App\Models\News;
use App\Models\Office;
use App\Models\OfficesType;
use App\Models\Province;
use App\Models\Questions;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = null;
        $news = News::query();
        $apps = Apps::query();
        $questions = Questions::query();
        $downloads = Downloads::query();
        if ($request->filled('search')){
            $search = $request->search;
            $news = $news->where('titulo','LIKE','%'.$search.'%')->orWhere(
                'descripcion','LIKE','%'.$search.'%')->get();
            $apps = $apps->where('titulo','LIKE','%'.$search.'%')->orWhere(
                'descripcion','LIKE','%'.$search.'%')->get();
            $downloads = $downloads->where('titulo','LIKE','%'.$search.'%')->orWhere(
                'descripcion','LIKE','%'.$search.'%')->get();
            $questions = $questions->where('pregunta','LIKE','%'.$search.'%')->orWhere(
                'respuesta','LIKE','%'.$search.'%')->get();
        }
        return view('home.search',compact('news',
            'apps','questions', 'downloads','search'));
    }
}
