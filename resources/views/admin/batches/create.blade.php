@extends('admin.default')

@section('page-header')
Batches <small>Add your new batch</small>
@stop

@section('content')
{!! Form::open([
'action' => ['BatchController@store']
])
!!}

@include('admin.batches.form')


{!! Form::close() !!}

@stop