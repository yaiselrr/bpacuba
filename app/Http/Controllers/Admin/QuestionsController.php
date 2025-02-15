<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdatedSite;
use App\Http\Requests\QuestionsStoreRequest;
use App\Http\Requests\QuestionsUpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:questions.create')->only(['create','store']);
        $this->middleware('hasPermission:questions.destroy')->only(['destroy']);
        $this->middleware('hasPermission:questions.index')->only(['index']);
        $this->middleware('hasPermission:questions.edit')->only(['update','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $questions = Questions::latest()->paginate(5);
        return view('admin.questions.index', ['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin.questions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsStoreRequest $request)
    {
        //
        $validated = $request->validated();
        Questions::create($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.questions.index')->with('success',__('bpa.add-content',['contenido'=>'Pregunta']));
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
    public function edit(Request $request,Questions $question)
    {
        //
        return view('admin.questions.edit',['question'=>$question]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsUpdateRequest $request, Questions $question)
    {
        //
        $validated = $request->validated();
        $question->update($validated);
        event(new UpdatedSite());
        return redirect()->route('admin.content.questions.index')->with('success',__('bpa.edit-content',['contenido'=>'Pregunta']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Questions::destroy($id);
        event(new UpdatedSite());
        return redirect()->route('admin.content.questions.index')->with('success',__('bpa.delete-content',['contenido'=>'Pregunta']));
    }
}
