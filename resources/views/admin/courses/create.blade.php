@extends('admin.default')

@section('page-header')
Courses <small>Add your new course</small>
@stop

@section('content')
{!! Form::open([
'action' => ['CourseController@store']
])
!!}

@include('admin.courses.form')


{!! Form::close() !!}

@stop