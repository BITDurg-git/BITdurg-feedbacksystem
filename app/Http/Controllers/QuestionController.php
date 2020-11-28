<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Question::class);
        return view('admin.questions.index')->with([
            'questions' => Question::latest('updated_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Question::class);
        return view('admin.questions.create')->with([
            'instructions' => config('instructions.question_create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Question::class);

        $data = $this->validate($request,Question::rules());

        Question::create($data);

        return redirect()->route('admin.questions.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Question::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Question::findOrFail($id);
        $this->authorize('update',$item);
        return view('admin.questions.edit',compact('item'))->with([
            'instructions' => []
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $question = Question::findOrFail($id);
        $this->authorize('update',$question);
        $data = $this->validate($request,Question::rules(true,$id));

        $question->update($data);

        return redirect()->route('admin.questions.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Question::findOrFail($id));
        Question::destroy($id);
        return redirect()->route('admin.questions.index')->withSuccess(trans('app.success_destroy'));
    }
}
