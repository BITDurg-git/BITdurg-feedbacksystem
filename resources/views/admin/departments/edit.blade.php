@extends('admin.default')

@section('page-header')
Departments <small>Add your new department</small>
@stop

@section('content')
{!! Form::model($item,[
'action' => ['DepartmentController@update', $item->id],
'method' => 'PUT'
])
!!}

@include('admin.departments.form')


{!! Form::close() !!}

@stop