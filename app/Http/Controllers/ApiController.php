<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;

class ApiController extends Controller
{
    public function getCourseByDepartment($department_id){
        return Course::where([['department_name','=',$department_id]])->pluck('course_name','id');
    }

    public function getSemesterByCourse($course_id){
        return Course::where([['id','=',$course_id]])->pluck('semester_count','semester_count');
    }
}
