@extends('admin.default')

@section('page-header')
Departments <small>Add your new department</small>
@stop

@section('content')
{!! Form::open([
'action' => ['DepartmentController@store']
])
!!}

@include('admin.departments.form')


{!! Form::close() !!}

@stop