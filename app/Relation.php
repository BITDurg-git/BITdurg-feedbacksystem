<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Batch;
use App\Subject;
use App\Teacher;

class Relation extends Model
{
    protected $fillable = [
        'subject_name','teacher_name','department_name','batch_name','theory_lab','relation_code', 'group_name'
    ];

    public static function rules($update = false,$id = null){
        $teachers = Teacher::all();
        $batches = Batch::where([['department_name','=',Auth::user()->department_name]])->get();
        $subjects = Subject::where([['department_name','=',Auth::user()->department_name]])->get();
        if(!$update)
            return [
                'teacher_name' => 'required|numeric|in:'.$teachers->implode('id',', '),
                'department_name' => 'required|numeric|in:'.Auth::user()->department_name,
                'subject_name' => "required|numeric|in:".$subjects->implode('id', ', '),
                'batch_name' => 'required|numeric|in:'.$batches->implode('id', ', '),
                'theory_lab' => 'required|numeric|in:0,1',
                'relation_code' => 'required|unique:relations',
                'group_name' => 'nullable'
            ];
        
            return [
                'subject_name' => "required|numeric|in:".$subjects->implode('id', ', '),
                'teacher_name' => 'required|numeric|in:'.$teachers->implode('id',', '),
                'department_name' => 'required|numeric|in:'.Auth::user()->department_name,
                'batch_name' => 'required|numeric|in:'.$batches->implode('id', ', '),
                'theory_lab' => 'required|numeric|in:0,1',
                'relation_code' => "required|unique:relations,relation_code,$id",
                'group_name' => 'nullable'
            ];
    }

    public function scopeAll(){
        return $query->latest('updated_at')->get();
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }

    public function getBatch(){
        return $this->belongsTo('App\Batch','batch_name');
    }

    public function getSubject(){
        return $this->belongsTo('App\Subject','subject_name');
    }

    public function getTeacher(){
        return $this->belongsTo('App\Teacher','teacher_name');
    }

    public function periods(){
        return $this->hasMany('App\Period','relation_name');
    }
}
