@extends('admin.default')

@section('page-header')
Courses <small>Edit course {{$item->course_name}}</small>
@stop

@section('content')
{!! Form::model($item,[
'action' => ['CourseController@update',$item->id],
'method' => 'PUT'
])
!!}

@include('admin.courses.form')


{!! Form::close() !!}

@stop