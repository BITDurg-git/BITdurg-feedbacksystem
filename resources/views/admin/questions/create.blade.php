@extends('admin.default')

@section('page-header')
Feedback Questions<small>Add your new feedback Question.</small>
@stop

@section('content')
{!! Form::open([
'action' => ['QuestionController@store'],
'files' => true
])
!!}

@include('admin.questions.form')


{!! Form::close() !!}

@stop