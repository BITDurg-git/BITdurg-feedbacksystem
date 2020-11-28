<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Subject;
use App\Course;
use App\Department;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $subjects = Subject::all();
        if(Auth::user()->role == 7)
            $subjects = Subject::latest('updated_at')->where([['department_name','=',Auth::user()->department_name]])->get();
        $this->authorize('viewAny',Subject::class);
        return view('admin.subjects.index')->with([
            'subjects' => $subjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Subject::class);
        return view('admin.subjects.create')->with([
            'instructions' => config('instructions.subject_create'),
            'courses' => Course::where([['department_name','=',Auth::user()->department_name]])->pluck('course_name','id'),
            'departments' => Department::pluck('department_code','id')
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
        $request->merge([
            'department_name' => Auth::user()->department_name
        ]);
        $this->authorize('create',Subject::class);
        $data = $this->validate($request, Subject::rules(false,null,$request->course_name));

        Subject::create($data);
        return redirect()->route('admin.subjects.create')->withSuccess('Subject added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Subject::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Subject::findOrFail($id);
        $this->authorize('update',$item);
        return view('admin.subjects.edit', compact('item'))->with([
            'instructions' => config('instructions.subject_create'),
            'courses' => Course::where([['department_name','=',Auth::user()->department_name]])->pluck('course_name','id'),
            'departments' => Department::pluck('department_code','id'),
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
        $request->merge([
            'department_name' => Auth::user()->department_name
        ]);
        $data = $this->validate($request, Subject::rules(true,$id,$request->course_name));
        $subject = Subject::findOrFail($id);
        $this->authorize('update',$subject);
        $subject->update($data);

        return redirect()->route('admin.subjects.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Subject::findOrFail($id));
        Subject::destroy($id);
        return redirect()->route('admin.subjects.index')->withSuccess('Subject deleted successfully.');
    }
}
