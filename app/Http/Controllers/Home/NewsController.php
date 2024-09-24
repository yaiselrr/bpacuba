<?php

namespace App\Http\Controllers\Home;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function index(Request $request)
    {
        $news = News::where('publica', true)->orderBy('fecha_publicacion')->paginate(10);
        return view('home.news',compact('news'));
    }
    public function show(Request $request, News $news)
    {
        return view('home.details',compact('news'));
    }
}
