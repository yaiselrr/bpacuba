<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\SurveyQuestionsRequest;
use App\Models\SurveyQuestions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SurveyQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:squestions.create')->only(['create','store']);
        $this->middleware('hasPermission:squestions.destroy')->only(['destroy']);
        $this->middleware('hasPermission:squestions.index')->only(['index']);
        $this->middleware('hasPermission:squestions.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $squestions = SurveyQuestions::latest()->paginate(5);
        return view('admin.squestions.index', compact('squestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.squestions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyQuestionsRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['created_by'] = Auth::user()->name;
        SurveyQuestions::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.squestions.index')->with('success',__('bpa.add-content',['contenido'=>'Pregunta']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,SurveyQuestions $squestion)
    {
        //
        return view('admin.squestions.edit',['squestion'=>$squestion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurveyQuestionsRequest $request, SurveyQuestions $squestion)
    {
        //
        $validated = $request->validated();
        $validated['created_by'] = Auth::user()->name;
        $squestion->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.squestions.index')->with('success',__('bpa.edit-content',['contenido'=>'Pregunta']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SurveyQuestions::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.squestions.index')->with('success',__('bpa.delete-content',['contenido'=>'Pregunta']));
    }
}
