<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Batch;
use App\Course;
use App\Department;
use App\User;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $batches = Batch::all();
        if(Auth::user()->role == 7)
            $batches = Batch::latest('updated_at')->where([['department_name','=',Auth::user()->department_name]])->get();
        $this->authorize('viewAny',Batch::class);
        return view('admin.batches.index')->with([
            'batches' => $batches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Batch::class);
        return view('admin.batches.create')->with([
            'instructions' => config('instructions.batch_create'),
            'courses' => Course::where([['department_name','=',Auth::user()->department_name]])->pluck('course_name','id'),
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
        $this->authorize('create',Batch::class);
        $course_name = Course::findOrFail($request->course_name)->course_name;
        $department_name = Department::findOrFail(Auth::user()->department_name)->department_code;
        $semester = $request->semester;
        $section = $request->section;
        $group = $request->group_name;
        $batch_code = $course_name.'_'.$department_name.'_'.$semester.'_'.$section;
        $request->merge([
            'batch_code' => $batch_code,
            'department_name' => Auth::user()->department_name
        ]);
        $data = $this->validate($request,Batch::rules(false,null,$request->course_name));

        Batch::create($data);
        return redirect()->route('admin.batches.index')->withSuccess('Batch created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Batch::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Batch::findOrFail($id);
        $this->authorize('update',$item);
        return view('admin.batches.edit',compact('item'))->with([
            'instructions' => [],
            'courses' => Course::where([['department_name','=',Auth::user()->department_name]])->pluck('course_name','id'),
            'departments' => Department::pluck('department_name','id')
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
        $batch = Batch::findOrFail($id);
        $this->authorize('update',$batch);
        $course_name = Course::findOrFail($request->course_name)->course_name;
        $department_name = Department::findOrFail(Auth::user()->department_name)->department_code;
        $semester = $request->semester;
        $section = $request->section;
        $group = $request->group_name;
        $batch_code = $course_name.'_'.$department_name.'_'.$semester.'_'.$section;
        $request->merge([
            'batch_code' => $batch_code,
            'department_name' => Auth::user()->department_name
        ]);
        $data = $this->validate($request,Batch::rules(true,$id,$request->course_name));

        
        $batch->update($data);
        return redirect()->route('admin.batches.index')->withSuccess('Batch Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Batch::findOrFail($id));
        Batch::destroy($id);
        return redirect()->route('admin.batches.index')->withSuccess(trans('app.success_destroy'));
    }
}
