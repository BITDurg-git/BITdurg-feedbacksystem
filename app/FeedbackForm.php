<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\FeedbackForm;
use App\FeedbackSubmission;
use Carbon\Carbon;
use App\Batch;
use App\Setting;
use App\Subject;
use DB;

class FeedbackForm extends Model
{
    protected $feedbackForm;
    protected $fillable = [
        'feedback_name', 'department_name', 'feedback_status', 'student_list', 'theory_lab','user_name','batch_name'
    ];

    public static function rules($update = false, $id = null){
        $batches = Batch::where([['department_name','=',Auth::user()->department_name]])->get();
        if(auth()->user()->role == 10){
            $batches = Batch::all();
        }
        if(!$update)
            return [
                'feedback_name' => 'required|unique:feedback_forms',
                'department_name' => 'required|numeric',
                'feedback_status' => 'required|numeric|in:0,1,2',
                'student_list' => 'required',
                'theory_lab' => 'required|numeric|in:0,1',
                'user_name' => 'required|numeric',
                'batch_name' => 'required|numeric|in:'.$batches->implode('id',', ')
            ];

        return [
            'feedback_name' => "required|unique:feedback_forms,feedback_name,$id",
            'department_name' => 'required|numeric',
            'feedback_status' => 'required|numeric|in:0,1,2',
            'student_list' => 'required',
            'theory_lab' => 'required|numeric|in:0,1',
            'user_name' => 'required|numeric',
            'batch_name' => 'required|numeric|in:'.$batches->implode('id',', ')
        ];
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }

    public function setStudentListAttribute($file){
        $this->attributes['student_list'] = move_file($file,'feedback-forms');
    }

    public function getStudentListAttribute($value){
        return config('variables.feedback-forms.public').$value;
    }

    public function getBatch(){
        return $this->belongsTo('App\Batch','batch_name');
    }


    public function scopeGetAll($query){
        return $query->latest('updated_at')->get();
    }

    public static function scopeGetStatus($query,$id){
        return $query->where([['id','=',$id],['feedback_status','=',1]])->firstOrFail();
    }
    
    public static function scopeGetFeedbackForm($query, $id){
        return $query->where([['id','=',$id]])->first();
    }

    public static function scopeCanEdit($query, $id){
        return $query->where([['id','=',$id],['feedback_status','=','0']])->firstOrFail();
    }
    
    public static function scopeCanDelete($query, $id){
        return $query->where([['id','=',$id],['feedback_status','=','0']])->orWhere([['id','=',$id],['feedback_status','=','2']])->firstOrFail();
    }

    public static function scopeGetFeedbackForms($query, $feedback_status){
        return $query->where([['feedback_status','=',$feedback_status]])->get();
    }

    public function scopeCanViewReport($query, $feedback_id){
        return $query->where([['id','=',$feedback_id],['feedback_status','=','2']])->firstOrFail();
    }

    public function students(){
        return $this->hasMany('App\Student','feedback_name');
    }

    public static function sendMail($id,$attendence){
        if(FeedbackForm::hasReport($id))
            return redirect()->route('admin.feedback-forms.index')->withErrors('Feedback session stopped. No student participated in this feedback.');
        FeedbackForm::hasReport($id);
        $data = FeedbackForm::getData($id,$attendence);
        $to_name = 'Principal BIT, Durg';
        $to_email = Setting::findOrFail(2)->value;
        $subject = 'Feedback Report: '.$data['feedback_form']->getDepartment->department_code.' '
                    .$data['feedback_form']->getBatch->getCourse->course_name.' '
                    .$data['feedback_form']->getBatch->semester
                    .$data['feedback_form']->getBatch->section;

        Mail::send('admin.feedback-forms.rawreport',$data, function($message) use ($to_name, $to_email,$subject){
            $message->to($to_email,$to_name)->subject($subject);
            $message->from('maillivingmint@gmail.com','BIT eFeedback System');
        });

    }

    public static function hasReport($id){
        return FeedbackSubmission::where([['feedback_name','=',$id]])->count()  == 0;
    }

    public static function getData($feedbackId, $attendence){
        $tpi0 = Setting::findOrFail(3)->value;
        FeedbackForm::canViewReport($feedbackId);
        $feedbackForm = FeedbackForm::where([['id','=',$feedbackId]])->first();
        $feedbacks = FeedbackSubmission::where([['feedback_name','=',$feedbackId]])->get();
        $count = 0;
        $report_t = array();
        $question_response = array();
        $teacher_response = array();
        $total_points = 0;
        
        //Theory
        //Get theory Questions
        if($feedbackForm->theory_lab == 0){
            $relations_t = Relation::where([['batch_name','=',$feedbackForm->batch_name],['theory_lab','=',0]])
                ->whereIn('subject_name',function($query) use ($feedbackForm){
                    $query->select('id')
                    ->from('subjects')
                    ->where('batch_name',$feedbackForm->batch_name)
                    ->where('theory_lab',0);
                })->get();
                $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();

                $relations_l = [];
                $questions_l = [];
        }
        else if($feedbackForm->theory_lab == 1){
            $relations_t = DB::table('relations')
                                ->where([['relations.batch_name','=',$feedbackForm->batch_name],['relations.theory_lab','=',1]])
                                ->join('subjects','relations.subject_name','=','subjects.id')
                                ->orderBy('subjects.subject_code','ASC')->get();
            $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

            $relations_t = [];
            $questions_t = [];
        }
        else{
            $relations_t = DB::table('relations')
                                ->where([['relations.batch_name','=',$feedbackForm->batch_name],['relations.theory_lab','=',1]])
                                ->join('subjects','relations.subject_name','=','subjects.id')
                                ->orderBy('subjects.subject_code','ASC')->get();
            $questions_l = Question::where([['theory_lab','=',1]])->orderBy('id','asc')->get();

            $relations_t = DB::table('relations')
                                ->where([['relations.batch_name','=',$feedbackForm->batch_name],['relations.theory_lab','=',0]])
                                ->join('subjects','relations.subject_name','=','subjects.id')
                                ->orderBy('subjects.subject_code','ASC')->get();
            $questions_t = Question::where([['theory_lab','=',0]])->orderBy('id','asc')->get();
        }
        
        
        
        $total_students_all = $total_students = Student::where([['feedback_name','=',$feedbackId]])->get();
        $student_attempted = Student::where([['feedback_name','=',$feedbackId],['feedback_status','=',1]])->get();
        foreach ($relations_t as $relation) {
            $teacher_name = $relation->teacher_name;
            // $student_attempted_new = 0;
            if($relation->group_name != null){
                $section = $relation->group_name;
                $total_students = Student::where([['feedback_name','=',$feedbackId],['group_name','=',$relation->group_name]])->get();
            }
            else{
                $section = $relation->getbatch->section;
                $total_students = Student::where([['feedback_name','=',$feedbackId]])->get();
            }
            foreach ($questions_t as $question) {
                $question_name = $question->id;
                //getting feedback for 1 teacher 1 question
                $question_sum = 0;
                $count = 0;
                $feedbacks = FeedbackSubmission::where([['teacher_name','=',$teacher_name],['question_name','=',$question_name],['feedback_name','=',$feedbackId],['attendence','>',$attendence]])->get();
                if($feedbackForm->getBatch->getDepartment->id == 11){
                    // if($relation->getSubject->main_elective == 1){
                        $feedbacks = FeedbackSubmission::where([['subject_id','=',$relation->subject_name],['teacher_name','=',$teacher_name],['question_name','=',$question_name],['feedback_name','=',$feedbackId],['attendence','>',$attendence]])->get();
                    // }
                }
                

                // $student_attempted_new = $student_attempted_new + (count($feedbacks)/count($questions_t));
                if(count($feedbacks) == 0){
                    continue ;
                }
                foreach ($feedbacks as $feedback) {
                    $question_sum = $question_sum + $feedback->points;
                    $count = $count + 1;
                }
                //equivalent points of a teacher for a subject for a question
                $eqivalent_points = $question_sum/$count;
                $question_array = array([
                    'question' => $question->question,
                    'points' => round($eqivalent_points,2)
                ]);
                $total_points = $total_points + $eqivalent_points;
                $question_response[] = $question_array;
            }
            $tpi = round((($total_points/(count($questions_t)*5))*25),2);
            $tpi5 = round((($total_points/(count($questions_t)*5))*5),2);

            if($relation->group_name){
                $student_attempted_new = Student::where([['feedback_name','=',$feedbackId],['feedback_status','=',1],['group_name','=',$relation->group_name]])->get()->count();
            }
            else{
                $student_attempted_new = Student::where([['feedback_name','=',$feedbackId],['feedback_status','=',1]])->get()->count();
                if($feedbackForm->getBatch->getDepartment->id == 11){
                    if($relation->getSubject->main_elective == 1){
                        // $student_attempted_new = Student::where([['feedback_name','=',$feedbackId],['feedback_status','=',1]])->get()->count();
                        $fb = FeedbackSubmission::where([['subject_id','=',$relation->subject_name],['teacher_name','=',$teacher_name],['feedback_name','=',$feedbackId],['attendence','>',$attendence]])->get();
                        $fb = $fb->unique('urn');
                        $student_attempted_new = $fb->count();
                    }
                }
            }
            $teacher_response = array([
                'name' => Teacher::findOrFail($relation->teacher_name)->teacher_name,
                'subject' => $relation->getSubject->subject_name,
                'subject_code' => $relation->getSubject->subject_code,
                'feedback' => $question_response,
                'tpi' => $tpi,
                'tpitotal' => $tpi0,
                'tpi5' =>  $tpi5,
                'attempted' => $student_attempted_new,
                'section' => $section,
                'total_students' => count($total_students)
            ]);
            $question_response = array();
            $total_points = 0;
            $report_t[] = $teacher_response;
        }

        

        $count = 0;
        $report_l = array();
        $question_response = array();
        $teacher_response = array();
        $total_points = 0;

        foreach ($relations_l as $relation) {
            $teacher_name = $relation->teacher_name;
            
            foreach ($questions_l as $question) {
                $question_name = $question->id;
                //getting feedback for 1 teacher 1 question
                $question_sum = 0;
                $count = 0;
                $feedbacks = FeedbackSubmission::where([['teacher_name','=',$teacher_name],['question_name','=',$question_name],['feedback_name','=',$feedbackId]])->get();
                foreach ($feedbacks as $feedback) {
                    $question_sum = $question_sum + $feedback->points;
                    $count = $count + 1;
                }
                //equivalent points of a teacher for a subject for a question
                $eqivalent_points = $question_sum/$count;
                $question_array = array([
                    'question' => $question->question,
                    'points' => round($eqivalent_points,2)
                ]);
                $total_points = $total_points + $eqivalent_points;
                $question_response[] = $question_array;
            }
            
            $tpi = round((($total_points/(count($questions_l)*5))*$tpi0),2);
            $tpi5 = round((($total_points/(count($questions_t)*5))*5),2);

            $teacher_response = array([
                'name' => $relation->getTeacher->teacher_name,
                'subject' => $relation->getSubject->subject_name,
                'subject_code' => $relation->getSubject->subject_code,
                'feedback' => $question_response,
                'tpi' => $tpi,
                'tpitotal' => $tpi0,
                'tpi5' =>  $tpi5

            ]);
            $question_response = array();
            $total_points = 0;
            $report_l[] = $teacher_response;
        }

        $academic_session = Setting::findOrFail(7);
        return array(
            'reports_t' => $report_t,
            'reports_l' => $report_l,
            'feedback_form' => $feedbackForm,
            'participatedStudent' => count($student_attempted),
            'attendence' => $attendence,
            'date' => Carbon::now()->format('M-d-Y'),
            'academic_session' => $academic_session,
            'total_students' => count($total_students_all)
        );
    }
}
