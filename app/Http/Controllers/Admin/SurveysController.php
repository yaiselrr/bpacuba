<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\SurveysRequest;
use App\Models\Ranks;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveysController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:surveys.create')->only(['create','store']);
        $this->middleware('hasPermission:surveys.destroy')->only(['destroy']);
        $this->middleware('hasPermission:surveys.index')->only(['index']);
        $this->middleware('hasPermission:surveys.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $surveys = Survey::latest()->paginate(5);
        return view('admin.surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.surveys.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveysRequest $request)
    {
        //
        $validated = $request->validated();
        Survey::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.surveys.index')->with('success',__('bpa.add-content',['contenido'=>'Encuesta']));
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
    public function edit(Request $request,Survey $survey)
    {
        //
        return view('admin.surveys.edit',compact('survey'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurveysRequest $request, Survey $survey)
    {
        //
        $validated = $request->validated();
        $survey->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.surveys.index')->with('success',__('bpa.edit-content',['contenido'=>'Encuesta']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Survey::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.surveys.index')->with('success',__('bpa.delete-content',['contenido'=>'Encuesta']));
    }
}
