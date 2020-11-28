<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Teacher;
use App\Department;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $teachers = Teacher::all();
        if(Auth::user()->role == 7)
            $teachers = Teacher::latest('updated_at')->where([['department_name','=',Auth::user()->department_name]])->get();
        return view('admin.teachers.index')->with([
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create')->with([
            'instructions' => config('instructions.teacher_create'),
            'departments' => Department::pluck('department_name','id')
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
        $data = $this->validate($request,Teacher::rules());
        Teacher::create($data);
        return redirect()->route('admin.teachers.index')->withSuccess(trans('app.success_store'));
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
    public function edit($id)
    {
        $item = Teacher::findOrFail($id);
        return view('admin.teachers.edit',compact('item'))->with([
            'instructions' => config('instructions.teacher_create'),
            'departments' => Department::where([['id','=',Auth::user()->department_name]])->pluck('department_name','id'),
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
        $data = $this->validate($request,Teacher::rules(true,$id));
        $teacher = Teacher::findOrFail($id);
        $teacher->update($data);
        return redirect()->route('admin.teachers.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        return redirect()->route('admin.teachers.index')->withSuccess(trans('app.success_destroy'));
    }
}
