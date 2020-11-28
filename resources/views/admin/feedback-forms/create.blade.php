@extends('admin.default')

@section('page-header')
Feedback Forms<small>Add your new feedback form.</small>
@stop

@section('content')
{!! Form::open([
'action' => ['FeedbackFormController@store'],
'files' => true
])
!!}

@include('admin.feedback-forms.form')


{!! Form::close() !!}

@stop