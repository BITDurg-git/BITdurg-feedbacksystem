<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Relation;
use App\Subject;
use App\Teacher;
use App\Batch;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $relations = Relation::all();
        if(Auth::user()->role == 7)
            $relations = Relation::latest('updated_at')->where([['department_name','=',Auth::user()->department_name]])->get();
        $this->authorize('viewAny',Relation::class);
        return view('admin.relations.index')->with([
            'relations' => $relations   
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Relation::class);

        return view('admin.relations.create')->with([
            'instructions' => config('instructions.relation_create'),
            'subjects' => Subject::where([['department_name','=',Auth::user()->department_name]])->pluck('subject_name','id'),
            'teachers' => Teacher::pluck('teacher_name','id'),
            'batches' => Batch::where([['department_name','=',Auth::user()->department_name]])->pluck('batch_code','id')
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
        $this->authorize('create',Relation::class);
        $batch = Batch::findOrFail($request->batch_name);
        $department_name = $batch->getDepartment->id;
        $theory_lab = Subject::findOrFail($request->subject_name)->theory_lab;
        $relation_code = $request->subject_name.'_'.$request->batch_name;
        if(auth()->user()->department_name == 7){
            $relation_code = $request->subject_name.'_'.$request->batch_name.'_'.$request->group_name;
        }
        if(auth()->user()->department_name == 11){
            $relation_code = $request->subject_name.'_'.$request->batch_name.'_'.$request->group_name.'_'.$request->teacher_name;
        }
        $request->merge([
            'department_name' => $department_name,
            'theory_lab' => $theory_lab,
            'relation_code' => $relation_code
        ]);

        $data = $this->validate($request,Relation::rules(false,null));

        Relation::create($data);

        return redirect()->route('admin.relations.create')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Relation::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Relation::findOrFail($id);
        $this->authorize('update',$item);

        return view('admin.relations.edit',compact('item'))->with([
            'instructions' => config('instructions.relation_create'),
            'subjects' => Subject::where([['department_name','=',Auth::user()->department_name]])->pluck('subject_name','id'),
            'teachers' => Teacher::pluck('teacher_name','id'),
            'batches' => Batch::where([['department_name','=',Auth::user()->department_name]])->pluck('batch_code','id')
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
        $relation = Relation::findOrFail($id);
        $this->authorize('update',$relation);

        $batch = Batch::findOrFail($request->batch_name);
        $department_name = $batch->getDepartment->id;
        $theory_lab = Subject::findOrFail($request->subject_name)->theory_lab;
        $relation_code = $request->subject_name.'_'.$request->batch_name;
        if(auth()->user()->department_name == 7){
            $relation_code = $request->subject_name.'_'.$request->batch_name.'_'.$request->group_name;
        }
        if(auth()->user()->department_name == 11){
            $relation_code = $request->subject_name.'_'.$request->batch_name.'_'.$request->group_name.'_'.$request->teacher_name;
        }
        $request->merge([
            'department_name' => $department_name,
            'theory_lab' => $theory_lab,
            'relation_code' => $relation_code
        ]);

        $data = $this->validate($request,Relation::rules(true,$id));

        $relation->update($data);

        return redirect()->route('admin.relations.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(Relation::findOrFail($id));
        Relation::destroy($id);
        return redirect()->route('admin.relations.index')->withSuccess(trans('app.success_destroy'));
    }
}
