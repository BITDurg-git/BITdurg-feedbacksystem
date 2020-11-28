<div class="row mB-40">
    <div class="col-md-6 col-lg-6">
        <div class="bgc-white p-20 bd mB-10">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    {!! Form::myInput('text', 'subject_name', 'Subject Name',['required']) !!}
                </div>
                <div class="col-md-4 col-lg-4">
                    {!! Form::myInput('text','subject_code','Subject Code',['required']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::mySelect('department_name', 'Department Name', $departments, Auth::user()->department_name, ['class' =>
                    'form-control select2','disabled']) !!}
                </div>
                <div class="col-md-3 col-lg-3">
                    {!! Form::mySelect('course_name', 'Course Name', $courses, null, ['class' => 'form-control
                    select2', 'placeholder' => 'Select', 'id' => 'course_name']) !!}
                </div>
                <div class="col-md-3 col-lg-3">
                    {!! Form::myInput('number','semester','Semester') !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::mySelect('main_elective', 'Main/Elective', config('variables.main_elective'), null,
                    ['class' => 'form-control select2', 'placeholder' => 'Select']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::mySelect('theory_lab', 'Theory/Lab', config('variables.theory_lab'), null, ['class'
                    => 'form-control select2', 'placeholder' => 'Select']) !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">{{ trans('app.add_button') }}</button>

    </div>
    <div class="col-md-6 col-lg-6">
        <div class="bd bgc-white p-20">
            <div class="layers">
                <!-- Widget Title -->
                <div class="layer w-100 mB-20">
                    <h6 class="lh-1 text-dark">Instructions</h6>
                </div>
            </div>
            <ul>
                @foreach ($instructions as $instruction)
                <li class="text-dark mB-10">{{$instruction}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>