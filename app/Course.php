<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class Course extends Model
{
    protected $fillable = [
        'course_name', 'semester_count', 'department_name'
    ];

    public static function rules($update = false, $id = null){
        $departments = Department::all();
        if(!$update)
        return [
            'department_name' => 'required|numeric|in:'.$departments->implode('id',', '),
            'course_name' => "required",
            'semester_count' => 'required|numeric|in:1,2,3,4,5,6,7,8'
        ];

        return [
            'department_name' => 'required|numeric|in:'.$departments->implode('id',', '),
            'course_name' => "required",
            'semester_count' => 'required|numeric|in:1,2,3,4,5,6,7,8'
        ];
    }

    public static function scopeAll(){
        return $query->latest('updated_at')->get();
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department','department_name');
    }
}
