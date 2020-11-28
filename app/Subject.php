<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Batch;
use App\Subject;

class Subject extends Model
{
    protected $fillable = [
        'subject_name', 'subject_code', 'semester', 'course_name', 'department_name', 'main_elective', 'theory_lab'
    ];

    public static function rules($update = false, $id = null,$course_id){
        $courses = Course::where([['department_name','=',Auth::user()->department_name]])->get();
        $department = Department::where([['id','=',Auth::user()->department_name]])->get();
        if(!$update)
            return [
                'subject_name' => 'required',
                'subject_code' => 'required',
                'semester' => 'required|numeric|lte:'.Course::findOrFail($course_id)->semester_count,
                'course_name' => 'required|numeric|in:'.$courses->implode('id', ', '),
                'department_name' => 'required|numeric|in:'.$department->implode('id',', '),
                'main_elective' => 'required|numeric|in:0,1',
                'theory_lab' => 'required|numeric|in:0,1'
            ];

        return [
                'subject_name' => "required",
                'subject_code' => "required",
                'semester' => 'required|numeric|lte:'.Course::findOrFail($course_id)->semester_count,
                'course_name' => 'required|numeric|in:'.$courses->implode('id', ', '),
                'department_name' => 'required|numeric|in:'.$department->implode('id',', '),
                'main_elective' => 'required|numeric|in:0,1',
                'theory_lab' => 'required|numeric|in:0,1',
        ];
    }

    public static function scopeAll(){
        return $query->latest('updated_at')->get();
    }

    public function getCourse(){
        return $this->belongsTo('App\Course','course_name');
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }
}
