<?php

namespace App\Http\Controllers\Home;
use App\Models\Survey;
use App\Models\SurveyQuestions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    //
    public function store(Request $request)
    {
        $rules=[];
        $messages = [];
        $preg = SurveyQuestions::all();
        foreach ($preg as $p){
            $rules['respuesta'.$p->id] = 'required';
            $messages['respuesta'.$p->id.'.required'] = 'Debe proporcionar una respuesta a cada pregunta';
        }
        $validator = Validator::make($request->all(), $rules,$messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();

        }
        else{
            Survey::create(
                [
//                    "estrellas"=> $request->get('valoracion'),
                    "sugerencias"=> $request->get('sugerencias')?? null
                ]
            );
            foreach ($preg as $p){
                $r= $request->get('respuesta'.$p->id);
                switch ($r){
                    case 'si':
                        $p->si=$p->si+1;
                        break;
                    case 'no':
                        $p->no=$p->no+1;
                        break;
                    case 'mejorar':
                        $p->mejorar=$p->mejorar+1;
                        break;
                }
                $p->save();
            }
            return redirect()->route('home.survey')->with('success','Encuesta guardada con éxito');
        }

    }

    public function create(Request $request)
    {
        //
        $preg = SurveyQuestions::all();
        return view('home.survey',compact('preg'));
    }
}
