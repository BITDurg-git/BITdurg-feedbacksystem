@extends('admin.default')

@section('page-header')
Feedback Export<small>Export Feedback.</small>
@stop

@section('content')
{!! Form::open([
'action' => ['ExportController@generate'],
'method' => 'POST'
])
!!}

<div class="row mB-40">
        <div class="col-md-6 col-lg-6">
            <div class="bgc-white p-20 bd mB-10">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        {!! Form::mySelect('feedback_name','Feedback Name',$feedback_forms,null,['class' =>
                        'form-control select2', 'placeholder' => 'Select', 'required']) !!}
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Export</button>
    
        </div>
    </div>


{!! Form::close() !!}

@stop