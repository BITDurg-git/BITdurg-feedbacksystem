<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Course;

class Batch extends Model
{
    protected $fillable = [
        'section','semester','department_name','batch_code','course_name'
    ];

    public static function rules($update = false, $id = null,$course_id){
        $semester = Course::findOrFail($course_id)->semester_count;
        $courses = Course::where([['department_name','=',Auth::user()->department_name]])->get();
        if(!$update)
            return [
                'section' => 'required|size:1',
                'semester' => "required|numeric|lte:".$semester,
                'department_name' => 'required|numeric|in:'.Auth::user()->department_name,
                'batch_code' => 'required|unique:batches',
                'course_name' => 'required|numeric|in:'.$courses->implode('id',', ')
            ];
        
        return [
            'section' => 'required|size:1',
            'semester' => "required|numeric|lte:".$semester,
            'department_name' => 'required|in:'.Auth::user()->department_name,
            'batch_code' => "required|unique:batches,batch_code,$id",
            'course_name' => 'required|numeric|in:'.$courses->implode('id',', ')
        ];
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }

    public function getCourse(){
        return $this->belongsTo('App\Course','course_name');
    }

    public function scopeAll(){
        return $query->latest('updates_at')->get();
    }
}
