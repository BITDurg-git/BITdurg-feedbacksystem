<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Student;
use App\Subject;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\FeedbackFrom;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{

    private $data;
    public $flag = true;

    public function __construct($data)
    {
        $this->data = $data; 
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            $urn = $row['urn'];
            $name = $row['name'];
            $password = $row['password'];
            $attendence = $row['attendence'];
            $e1 = null;
            $e2 = null;
            $e3 = null;
            $e4 = null;
            $e5 = null;
            $e6 = null;
            $e7 = null;
            $e8 = null;
            $e9 = null;
            $e10 = null;
            if($this->data->department_name != 7 && $this->data->department_name != 11){
                $e1Code = $row['elective1'];
                $e2Code = $row['elective2'];

                $e1 = Subject::where([['main_elective','=','1'],['subject_code','=',$e1Code]])->first();
                $e2 = Subject::where([['main_elective','=','1'],['subject_code','=',$e2Code]])->first();
            }
            if($this->data->department_name == 11){
                $e1Code = $row['sp11'];
                $e2Code = $row['sp12'];
                $e3Code = $row['sp21'];
                $e4Code = $row['sp22'];
                $e5Code = $row['sp31'];
                $e6Code = $row['sp32'];
                $e7Code = $row['sp41'];
                $e8Code = $row['sp42'];
                $e9Code = $row['sp51'];
                $e10Code = $row['sp52'];

                $e1 = Subject::where([['main_elective','=','1'],['subject_code','=',$e1Code]])->first();
                $e2 = Subject::where([['main_elective','=','1'],['subject_code','=',$e2Code]])->first();
                $e3 = Subject::where([['main_elective','=','1'],['subject_code','=',$e3Code]])->first();
                $e4 = Subject::where([['main_elective','=','1'],['subject_code','=',$e4Code]])->first();
                $e5 = Subject::where([['main_elective','=','1'],['subject_code','=',$e5Code]])->first();
                $e6 = Subject::where([['main_elective','=','1'],['subject_code','=',$e6Code]])->first();
                $e7 = Subject::where([['main_elective','=','1'],['subject_code','=',$e7Code]])->first();
                $e8 = Subject::where([['main_elective','=','1'],['subject_code','=',$e8Code]])->first();
                $e9 = Subject::where([['main_elective','=','1'],['subject_code','=',$e9Code]])->first();
                $e10 = Subject::where([['main_elective','=','1'],['subject_code','=',$e10Code]])->first();
            }
            $email_id = $urn.'@bitdurg.ac.in';
    
            $user = User::where([['email','=',$email_id]])->first();
            if($user == null){
                $user = new User();
                $user->role = 5;
                $user->name = $name;
                $user->email = $email_id;
                $user->password = $urn;
                $user->department_name = $this->data->department_name;
                $user->save();
            }
            else{
                $user->role = 5;
                $user->name = $name;
                $user->email = $email_id;
                $user->password = $urn;
                $user->department_name = $this->data->department_name;
                $user->update();
            }
            $student = Student::where([['user_id','=',$user->id],['feedback_name','=',$this->data->id]])->first();
            if($student == null){
                $student = new Student();
                $student->user_id = $user->id;
                $student->name = $name;
                $student->feedback_name = $this->data->id;
                $student->feedback_status = 0;
                $student->urn = $urn;
                $student->attendence = $attendence;
                if($this->data->department_name == 7){
                    $student->group_name = $row['group'];
                }
                if($e1 != null){
                    $student->e1_id = $e1->id;
                }
                if($e2 != null){
                    $student->e2_id = $e2->id;
                }
                if($e3 != null){
                    $student->e3_id = $e3->id;
                }
                if($e4 != null){
                    $student->e4_id = $e4->id;
                }
                if($e5 != null){
                    $student->e5_id = $e5->id;
                }
                if($e6 != null){
                    $student->e6_id = $e6->id;
                }
                if($e7 != null){
                    $student->e7_id = $e7->id;
                }
                if($e8 != null){
                    $student->e8_id = $e8->id;
                }
                if($e9 != null){
                    $student->e9_id = $e9->id;
                }
                if($e10 != null){
                    $student->e10_id = $e10->id;
                }
                $student->save();
            }
            else{
                $student = new Student();
                $student->user_id = $user->id;
                $student->name = $name;
                $student->feedback_name = $this->data->id;
                $student->urn = $urn;
                $student->feedback_status = 0;
                $student->attendence = $attendence;
                if(auth()->user()->department_name == 7){
                    $student->group_name = $row['group'];
                }
                if($e1 != null){
                    $student->e1_id = $e1->id;
                }
                if($e2 != null){
                    $student->e2_id = $e2->id;
                }
                if($e3 != null){
                    $student->e3_id = $e3->id;
                }
                if($e4 != null){
                    $student->e4_id = $e4->id;
                }
                if($e5 != null){
                    $student->e5_id = $e5->id;
                }
                if($e6 != null){
                    $student->e6_id = $e6->id;
                }
                if($e7 != null){
                    $student->e7_id = $e7->id;
                }
                if($e8 != null){
                    $student->e8_id = $e8->id;
                }
                if($e9 != null){
                    $student->e9_id = $e9->id;
                }
                if($e10 != null){
                    $student->e10_id = $e10->id;
                }
                $student->update();
            }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
