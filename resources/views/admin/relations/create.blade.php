@extends('admin.default')

@section('page-header')
Teacher-Subject Relation Mapping<small>Add your new relation.</small>
@stop

@section('content')
{!! Form::open([
'action' => ['RelationController@store'],
'files' => true
])
!!}

@include('admin.relations.form')


{!! Form::close() !!}

@stop