@extends('admin.default')

@section('page-header')
Teacher-Subject Relation <small>Edit</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['RelationController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

        @include('admin.relations.form')
        		
	{!! Form::close() !!}
	
@stop
