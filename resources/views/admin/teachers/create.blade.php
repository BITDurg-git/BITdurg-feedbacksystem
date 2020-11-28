@extends('admin.default')

@section('page-header')
Teachers<small>Add your new teacher</small>
@stop

@section('content')
{!! Form::open([
'action' => ['TeacherController@store'],
'files' => true
])
!!}

@include('admin.teachers.form')


{!! Form::close() !!}

@stop