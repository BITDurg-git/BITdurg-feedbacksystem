<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Department::class);
        return view('admin.departments.index')->with([
            'departments' => \App\Department::latest('updated_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Department::class);
        return view('admin.departments.create')->with([
            'instructions' => config('instructions.departments_create')
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
        $this->authorize('create',Department::class);
        $data =  $this->validate($request, Department::rules());
        Department::create($data);

        return redirect()->route('admin.departments.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('create',Department::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Department::findOrFail($id);
        $this->authorize('update',$item);
        return view('admin.departments.edit', compact('item'))->with([
            'instructions' => config('instructions.departments_create')
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
        $this->authorize('update',Department::findOrFail($id));

        $data =  $this->validate($request, Department::rules(true,$id));
        $department = Department::findOrFail($id);
        $department->update($data);

        return redirect()->route('admin.departments.index')->withSuccess('Department details updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('create',Department::findOrFail($id));
        Department::destroy($id);
        return redirect()->route('admin.departments.index')->withSuccess(trans('app.success_destroy')); 
    }
}
