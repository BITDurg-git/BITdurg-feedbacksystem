@extends('admin.default')

@section('page-header')
Feedback Question <small>Edit</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['QuestionController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

        @include('admin.questions.form')
        		
	{!! Form::close() !!}
	
@stop
