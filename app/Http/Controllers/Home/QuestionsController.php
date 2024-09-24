<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\ContactInfo;
use App\Models\Questions;
use App\Models\Staff;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    //
    public function index()
    {
        $questions = Questions::latest()->paginate(10);
        return view('home.questions',compact('questions'));
    }
}
