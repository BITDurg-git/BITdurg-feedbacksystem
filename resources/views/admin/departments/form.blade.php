<div class="row mB-40">
    <div class="col-md-6 col-lg-6">
        <div class="bgc-white p-20 bd mB-10">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    {!! Form::myInput('text', 'department_name', 'Deparment Name',['required']) !!}
                </div>
                <div class="col-md-4 col-lg-4">
                    {!! Form::myInput('text','department_code','Department Code',['required']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::myInput('text','department_hod_name','HOD Name',['required']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::myInput('email','department_hod_email','HOD Email-Id',['required']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::myInput('number','hod_emp_id','HOD Employee Id',['required']) !!}
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