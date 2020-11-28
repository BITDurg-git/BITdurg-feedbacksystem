@extends('admin.default')

@section('page-header')
Subjects <small>Edit {{$item->subject_name}}</small>
@stop

@section('content')
{!! Form::model($item,[
'action' => ['SubjectController@update',$item->id],
'method' => 'PUT'
])
!!}

@include('admin.subjects.form')


{!! Form::close() !!}

@stop