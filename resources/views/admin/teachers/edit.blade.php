@extends('admin.default')

@section('page-header')
Teacher <small>Edit {{$item->teacher_name}}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['TeacherController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

        @include('admin.teachers.form')
        		
	{!! Form::close() !!}
	
@stop
