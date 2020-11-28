<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\FeedbackForm;
use App\Student;
use App\Relation;
use App\Question;
use App\Subject;
use App\FeedbackSubmission;
use App\Setting;

class FeedbackController extends Controller
{
    public function initiateFeedback($feedback_name){
        $student_name = Auth::user()->id;
        $student = Student::hasFeedbackAuth($feedback_name);
        $feedback_form = FeedbackForm::getFeedbackForm($feedback_name);
        if($feedback_form->feedback_status == 0){
            return redirect()->route('student.dashboard.index')->withErrors('Feedback session not yet started.');
        }
        elseif($feedback_form->feedback_status == 2){
            return redirect()->route('student.dashboard.index')->withErrors('Feedback session completed');
        }
        else{
            $feedbackForm = FeedbackForm::where([['id','=',$feedback_name]])->first();
            //Theory
            //Get theory Questions
            if($feedbackForm->theory_lab == 0){
                $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])
                ->whereIn('subject_name',function($query) use ($feedbackForm, $student){
                    $query->select('id')
                    ->from('subjects')
                    ->where('batch_name',$feedbackForm->batch_name)
                    ->where('theory_lab',0);
                })->get();

                if(auth()->user()->department_name == 11){

                    $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])
                    ->whereIn('subject_name',function($query) use ($feedbackForm, $student){
                        $query->select('id')
                        ->from('subjects')
                        ->where('batch_name',$feedbackForm->batch_name)
                        ->where('main_elective',0)
                        ->where('theory_lab',0);
                    })->get();


                    $relation_e1 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e1_id]])->get();
                    $relation_e2 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e2_id]])->get();
                    $relation_e3 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e3_id]])->get();
                    $relation_e4 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e4_id]])->get();
                    $relation_e5 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e5_id]])->get();
                    $relation_e6 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e6_id]])->get();
                    $relation_e7 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e7_id]])->get();
                    $relation_e8 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e8_id]])->get();
                    $relation_e9 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e9_id]])->get();
                    $relation_e10 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e10_id]])->get();

                    $relation_t = $relation_t->merge($relation_e1);
                    $relation_t = $relation_t->merge($relation_e2);
                    $relation_t = $relation_t->merge($relation_e3);
                    $relation_t = $relation_t->merge($relation_e4);
                    $relation_t = $relation_t->merge($relation_e5);
                    $relation_t = $relation_t->merge($relation_e6);
                    $relation_t = $relation_t->merge($relation_e7);
                    $relation_t = $relation_t->merge($relation_e8);
                    $relation_t = $relation_t->merge($relation_e9);
                    $relation_t = $relation_t->merge($relation_e10);



                }
                $relation_t_g = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0],['group_name','=',$student->group_name],['group_name','!=',null]])->get();
                $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();

                $relation_l = [];
                $questions_l = [];

            }
            else if($feedbackForm->theory_lab == 1){
                $relation_l = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',1]])->get();
                $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

                $relation_t = [];
                $questions_t = [];
            }
            else{
                $relation_l = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',1]])->get();
                $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

                $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])->get();
                $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();
            }

            $e1 = Subject::where([['id','=',$student->e1_name]])->first();
            $e2 = Subject::where([['id','=',$student->e2_name]])->first();
            if($e1 != null)
                $e1_r = Relation::where([['subject_name','=',$e1->id],['batch_name','=',$feedbackForm->batch_name]])->first();
            else
                $e1_r = null;
            if($e2 != null)
                $e2_r = Relation::where([['subject_name','=',$e2->id],['batch_name','=',$feedbackForm->batch_name]])->first();
            else
                $e2_r = null;

            return view('student.feedback.index')->with([
                'feedbackForm' => $feedbackForm,
                'relation_t' => $relation_t,
                'relation_t_g' => $relation_t_g,
                'questions_t' => $questions_t,
                'relation_l' => $relation_l,
                'questions_l' => $questions_l,
                'e1_r' => $e1_r,
                'e2_r' => $e2_r,
                'student' => $student
            ]);;
        }

        
    }

    public function storeFeedback(Request $request, $id){
        $student_name = Student::where([['user_id','=',Auth::user()->id]])->first()->id;
        $student = Student::hasFeedbackAuth($id);
        

        $feedbackForm = FeedbackForm::where([['id','=',$id]])->first();
        if($feedbackForm->theory_lab == 0){
            $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])
                ->whereIn('subject_name',function($query) use ($feedbackForm, $student){
                    $query->select('id')
                    ->from('subjects')
                    ->where('batch_name',$feedbackForm->batch_name)
                    ->where('theory_lab',0);
                })->get();

                if(auth()->user()->department_name == 11){

                    $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])
                    ->whereIn('subject_name',function($query) use ($feedbackForm, $student){
                        $query->select('id')
                        ->from('subjects')
                        ->where('batch_name',$feedbackForm->batch_name)
                        ->where('main_elective',0)
                        ->where('theory_lab',0);
                    })->get();

                    $relation_e1 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e1_id]])->get();
                    $relation_e2 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e2_id]])->get();
                    $relation_e3 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e3_id]])->get();
                    $relation_e4 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e4_id]])->get();
                    $relation_e5 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e5_id]])->get();
                    $relation_e6 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e6_id]])->get();
                    $relation_e7 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e7_id]])->get();
                    $relation_e8 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e8_id]])->get();
                    $relation_e9 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e9_id]])->get();
                    $relation_e10 = Relation::where([['batch_name','=',$feedbackForm->batch_name],['subject_name','=',$student->e10_id]])->get();
                    $relation_t = $relation_t->merge($relation_e1);
                    $relation_t = $relation_t->merge($relation_e2);
                    $relation_t = $relation_t->merge($relation_e3);
                    $relation_t = $relation_t->merge($relation_e4);
                    $relation_t = $relation_t->merge($relation_e5);
                    $relation_t = $relation_t->merge($relation_e6);
                    $relation_t = $relation_t->merge($relation_e7);
                    $relation_t = $relation_t->merge($relation_e8);
                    $relation_t = $relation_t->merge($relation_e9);
                    $relation_t = $relation_t->merge($relation_e10);
                }
                $relation_t_g = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0],['group_name','=',$student->group_name],['group_name','!=',null]])->get();
                $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();
                $relation_l = [];
                $questions_l = [];
        }
        else if($feedbackForm->theory_lab == 1){
            $relation_l = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',1]])->get();
            $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

            $relation_t = [];
            $questions_t = [];
        }
        else{
            $relation_l = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',1]])->get();
            $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

            $relation_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])->get();
            $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();
        }

        foreach ($relation_t as $eachRelation) {
            //For each question get the value of input stars
            $teacher_name = $eachRelation->teacher_name;
            $subject_name = $eachRelation->subject_name;
            foreach ($questions_t as $question) {
                $question_name = $question->id;
                $val = 's'.$teacher_name.$subject_name.$question_name;
                $points = $request->$val;
                if($points == null)
                    break;
                $feedbackSubmission = new FeedbackSubmission();
                $feedbackSubmission->teacher_name = $teacher_name;
                $feedbackSubmission->student_name = $student_name;
                $feedbackSubmission->attendence = $student->attendence;
                $feedbackSubmission->feedback_name = $id;
                $feedbackSubmission->question_name = $question_name;
                $feedbackSubmission->points = $points;
                $feedbackSubmission->urn = $student->urn;
                $feedbackSubmission->subject_id = $eachRelation->subject_name;
                $feedbackSubmission->save();
            }
        }

        foreach ($relation_l as $eachRelation) {
            //For each question get the value of input stars
            $teacher_name = $eachRelation->teacher_name;
            foreach ($questions_l as $question) {
                $question_name = $question->id;
                $val = 's'.$teacher_name.$question_name;
                $points = $request->$val;

                $feedbackSubmission = new FeedbackSubmission();
                $feedbackSubmission->teacher_name = $teacher_name;
                $feedbackSubmission->student_name = $student_name;
                $feedbackSubmission->attendence = $student->attendence;
                $feedbackSubmission->feedback_name = $id;
                $feedbackSubmission->question_name = $question_name;
                $feedbackSubmission->subject_id = $eachRelation->subject_name;
                $feedbackSubmission->points = $points;
                $feedbackSubmission->urn = $student->urn;
                $feedbackSubmission->save();
            }
        }

        // $e1 = Subject::where([['id','=',$student->e1_id]])->first();
        //     $e2 = Subject::where([['id','=',$student->e2_id]])->first();
        //     if($e1 != null){
        //         $e1_r = Relation::where([['subject_name','=',$e1->id],['batch_name','=',$feedbackForm->batch_name]])->first();

        //         foreach ($questions_t as $question) {
        //             $teacher_name = $e1_r->teacher_name;
        //             $question_name = $question->id;
        //             $val = 's'.$teacher_name.$question_name;
        //             $points = $request->$val;
    
        //             $feedbackSubmission = new FeedbackSubmission();
        //             $feedbackSubmission->teacher_name = $teacher_name;
        //             $feedbackSubmission->student_name = $student_name;
        //             $feedbackSubmission->attendence = $student->attendence;
        //             $feedbackSubmission->feedback_name = $id;
        //             $feedbackSubmission->question_name = $question_name;
        //             $feedbackSubmission->points = $points;
        //             $feedbackSubmission->urn = $student->urn;
        //             $feedbackSubmission->save();
        //         }
                
        //     }

        //     if($e2 != null){
        //         $e2_r = Relation::where([['subject_name','=',$e2->id],['batch_name','=',$feedbackForm->batch_name]])->first();
        //         foreach ($questions_t as $question) {
        //             $teacher_name = $e2_r->teacher_name;
        //             $question_name = $question->id;
        //             $val = 's'.$teacher_name.$question_name;
        //             $points = $request->$val;
    
        //             $feedbackSubmission = new FeedbackSubmission();
        //             $feedbackSubmission->teacher_name = $teacher_name;
        //             $feedbackSubmission->student_name = $student_name;
        //             $feedbackSubmission->attendence = $student->attendence;
        //             $feedbackSubmission->feedback_name = $id;
        //             $feedbackSubmission->question_name = $question_name;
        //             $feedbackSubmission->points = $points;
        //             $feedbackSubmission->urn = $student->urn;
        //             $feedbackSubmission->save();
        //         }
        //     }


        $student->feedback_status = 1;
        $student->update();
        return redirect()->route('student.dashboard.index')->withSuccess('Thank You! Your feedback has been taken.');
    }

    public function report($id,$attendence){
        $this->authorize('viewReport',FeedbackForm::class);
        if(FeedbackForm::hasReport($id))
            return redirect()->route('admin.feedback-forms.index')->withErrors('No student participated in this feedback.');
        $report = FeedbackForm::getData($id,$attendence);
        if($report == null)
            return redirect()->route('admin.feedback-forms.report',[$id,0])->withErrors('No students above '.$attendence.'% attendence.');
        return view('admin.feedback-forms.report')->with($report);
    }


    public function printReport($id,$attendence){
        $this->authorize('viewReport',FeedbackForm::class);
        FeedbackForm::hasReport($id);
        $report = FeedbackForm::getData($id,$attendence);
        if($report == null)
            return redirect()->route('admin.feedback-forms.report',[$id,0])->withErrors('No students above '.$attendence.'% attendence.');
        return view('admin.feedback-forms.rawreport')->with($report);
    }

    public function sendMail($id,$attendence){
        if(FeedbackForm::hasReport($id))
            return redirect()->route('admin.feedback-forms.index')->withErrors('Feedback session stopped. No student participated in this feedback.');
        FeedbackForm::sendMail($id,$attendence);
        $report = FeedbackForm::getData($id,$attendence);
        if($report == null)
            return redirect()->route('admin.feedback-forms.report',[$id,0])->withErrors('No students above '.$attendence.'% attendence.');
        return redirect()->route('admin.feedback-forms.index',$id)->withSuccess('Email Send');
    }  
}
