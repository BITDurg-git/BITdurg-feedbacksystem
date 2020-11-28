<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Department;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $courses = Course::all();
        if(Auth::user()->role == 7)
            $courses = Course::latest('updated_at')->get();
        $this->authorize('viewAny',Course::class);
        return view('admin.courses.index')->with([
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Course::class);
        return view('admin.courses.create')->with([
            'instructions' => config('instructions.courses_create'),
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
        $this->authorize('create',Course::class);
        $data = $this->validate($request, Course::rules());
        Course::create($data);
        return redirect()->route('admin.courses.index')->withSuccess('Course added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Course::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Course::findOrFail($id);
        $this->authorize('update',$item);
        return view('admin.courses.edit', compact('item'))->with([
            'instructions' => config('instructions.courses_create'),
            'departments' => Department::pluck('department_code','id')
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
        $data = $this->validate($request, Course::rules(true,$id));
        $course = Course::findOrFail($id);
        $this->authorize('update',$course);
        $course->update($data);
        return redirect()->route('admin.courses.index')->withSuccess('Course details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('update',Course::findOrFail($id));
        Course::destroy($id);
        return redirect()->route('admin.courses.index')->withSuccess(trans('app.success_destroy'));
    }
}
