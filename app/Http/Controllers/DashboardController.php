<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Feedback;
use App\Student;
use App\Department;
use App\Course;
use App\Subject;
use App\Teacher;
use App\Batch;
use App\FeedbackForm;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('d F Y');
        $day = Carbon::now()->format('l');
        $hrs = Carbon::now()->format('H');
        $feedback_forms = FeedbackForm::where([['feedback_status','=',2]])->get();
        $greetings = '';
        if($hrs > 16)
            $greetings = "Good Evening!";
        elseif ($hrs > 12) {
            $greetings = "Good Afternoon!";
        }
        else{
            $greetings = "Good Morning!";
        }
        return view('admin.dashboard.index')->with([
            'departments' => Department::all(),
            'courses' => Course::all(),
            'subjects' => Subject::all(),
            'teachers' => Teacher::all(),
            'batches' => Batch::all(),
            'date' => $date,
            'day' => $day,
            'greetings' => $greetings,
            'feedback_forms' => $feedback_forms,
            
        ]);
    }

    public function student(){
        $date = Carbon::now()->format('d F Y');
        $day = Carbon::now()->format('l');
        $hrs = Carbon::now()->format('H');
        $feedbacks = Student::FeedbackList();
        $greetings = '';
        if($hrs > 16)
            $greetings = "Good Evening!";
        elseif ($hrs > 12) {
            $greetings = "Good Afternoon!";
        }
        else{
            $greetings = "Good Morning!";
        }
        return view('student.dashboard.index')->with([
            'date' => $date,
            'day' => $day,
            'greetings' => $greetings,
            'feedbacks' => $feedbacks
        ]);
    }
}
