<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FeedbackForm;
use App\Student;
use Carbon\Carbon;
use App\Setting;
use App\FeedbackSession;

class FeedbackSessionController extends Controller
{
    
    public function index(){
    if(Auth::user()->role == 10)
        $feedback_form = FeedbackForm::latest('updated_at')->where([['feedback_status','=',1]])->get();
    if(Auth::user()->role == 7)
        $feedback_form = FeedbackForm::latest('updated_at')->where([['department_name','=',Auth::user()->department_name],['feedback_status','=',1]])->get();
    return view('admin.feedback-sessions.index')->with([
        'feedback_forms' => $feedback_form
    ]);
    }

    public function create(){
        $this->authorize('create',FeedbackSession::class);
        if(Auth::user()->role == 10)
            $feedback_form = FeedbackForm::where([['feedback_status','=','0']])->pluck('feedback_name','id');
        if(Auth::user()->role == 7)
            $feedback_form = FeedbackForm::where([['feedback_status','=','0'],['department_name','=',Auth::user()->department_name]])->pluck('feedback_name','id');
        return view('admin.feedback-sessions.create')->with([
            'instructions' => config('instructions.session_create'),
            'feedback_forms' => $feedback_form
        ]);
    }

    public function startFeedback(Request $request){
        $feedback_form = FeedbackForm::findOrFail($request->feedback_name);
        $this->authorize('update',$feedback_form);
        $feedback_form->feedback_status = 1;
        $feedback_form->update();
        

        $feedback_form = FeedbackForm::getStatus($feedback_form->id);
        $current_time = Carbon::now();
        $start_time = $feedback_form->updated_at;
        $total_duration = $current_time->diffInSeconds($start_time);
        $students = Student::where([['feedback_name','=',$feedback_form->id]])->get();
        return view('admin.feedback-sessions.view')->with([
            'feedback_form' => $feedback_form,
            'students' => $students,
            'total_duration' => $total_duration
        ]);
    }

    public function stopFeedback($id){
        $feedback_form = FeedbackForm::findOrFail($id);
        $this->authorize('update',$feedback_form);
        $feedback_form->feedback_status = 2;
        $feedback_form->update();
        $setting = Setting::findOrFail(4);
        if(FeedbackForm::hasReport($id))
            return redirect()->route('admin.feedback-forms.index')->withErrors('Feedback session stopped. No student participated in this feedback.');
        if($setting->value == 1){
            FeedbackForm::sendMail($id,0);
            return redirect()->route('admin.feedback-sessions.index')->withSuccess('Feedback Session stopped & Mail Sent.');    
        }
        return redirect()->route('admin.feedback-sessions.index')->withSuccess('Feedback Session stopped');
    }

    public function view($id){
        $feedback_form = FeedbackForm::getStatus($id);
        $this->authorize('view',$feedback_form);
        $current_time = Carbon::now();
        $start_time = $feedback_form->updated_at;
        $total_duration = $current_time->diffInSeconds($start_time);
        $students = Student::where([['feedback_name','=',$id]])->get();
        return view('admin.feedback-sessions.view')->with([
            'feedback_form' => $feedback_form,
            'students' => $students,
            'total_duration' => $total_duration
        ]);
    }
}
