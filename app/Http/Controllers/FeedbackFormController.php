<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedbackForm;
use App\Batch;
use Illuminate\Support\Facades\Auth;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Student;
use App\FeedbackSubmission;


class FeedbackFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 10)
            $feedback_form = FeedbackForm::all();
        if(Auth::user()->role == 7)
            $feedback_form = FeedbackForm::latest('updated_at')->where([['department_name','=',Auth::user()->department_name]])->get();
        return view('admin.feedback-forms.index')->with([
            'feedback_forms' => $feedback_form
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',FeedbackForm::class);
        if(Auth::user()->role == 10)
            $batches = Batch::pluck('batch_code','id');
        if(Auth::user()->role == 7)
            $batches = Batch::where([['department_name','=',Auth::user()->department_name]])->pluck('batch_code','id');

        return view('admin.feedback-forms.create')->with([
            'batches' => $batches,
            'instructions' => (auth()->user()->department_name == 7) ? config('instructions.feedback_create_fyr') : config('instructions.feedback_create_all')
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
        $this->authorize('create',FeedbackForm::class);

        $batch = Batch::findOrFail($request->batch_name);
        $feedback_name = 'FB_'.$batch->batch_code;
        $request->merge([
            'feedback_name' => $feedback_name,
            'department_name' => $batch->department_name,
            'feedback_status' => 0,
            'user_name' => Auth::user()->id
        ]);
        $data = $this->validate($request,FeedbackForm::rules());

        $feedback = FeedbackForm::create($data);
        $feedback->feedback_name = $feedback->id.'_'.$feedback->feedback_name;
        $feedback->update();
        $batch->feedback_index = $batch->feedback_index + 1;
        $batch->update();

        $excel_file_link =  $feedback->student_list;

        $import = new UsersImport($feedback);
        try {
            Excel::import($import, public_path($excel_file_link));
        } catch (\Throwable $th) {
            $feedback->delete();
            $batch = Batch::findOrfail($feedback->batch_name);
            $batch->feedback_index = $batch->feedback_index - 1;
            $batch->update();
            return redirect()->route('admin.feedback-forms.create')->withErrors('Error in your excel file. Please stick to given format');
        }

        return redirect()->route('admin.feedback-forms.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',FeedbackForm::findOrFail($id));
        return view('admin.feedback-forms.view')->with([
            'feedback_form' => FeedbackForm::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update',FeedbackForm::findOrFail($id));
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
        $this->authorize('update',FeedbackForm::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',FeedbackForm::findOrFail($id));
        $feedback_form = FeedbackForm::findOrFail($id);
        FeedbackForm::canDelete($id);
        FeedbackForm::destroy($id);
        $batch = Batch::findOrfail($feedback_form->batch_name);
        $batch->feedback_index = $batch->feedback_index - 1;
        $batch->update();

        FeedbackSubmission::where([['feedback_name','=',$id]])->delete();

        return redirect()->route('admin.feedback-forms.index')->withSuccess(trans('app.success_destroy'));
    }
}
