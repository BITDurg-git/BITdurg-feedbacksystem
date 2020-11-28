<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Auth;
use App\Subject;

class StudentController extends Controller
{
    public function edit($id){
        $student = Student::findOrFail($id);
        $this->authorize('update',$student);
        if(Auth::user()->role == 10)
            $electives = Subject::where('main_elective',1)->pluck('subject_name','id');
        if(Auth::user()->role == 7)
            $electives = Subject::where('main_elective',1)->where('department_name',auth()->user()->department_name)->pluck('subject_name','id');
        return view('admin.students.edit')->with([
            'item' => $student,
            'electives' => $electives
        ]);
    }

    public function update($id,Request $request){
        $student = Student::findOrFail($id);
        $student->update($request->all());
        $student->save();

        return redirect()->route('admin.feedback-forms.show',$student->feedback_name)->withSuccess('Student Updated');
    }
}
