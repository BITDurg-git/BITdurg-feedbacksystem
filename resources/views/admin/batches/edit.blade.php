@extends('admin.default')

@section('page-header')
Batch <small>Edit {{$item->batch_code}}</small>
@stop

@section('content')
{!! Form::model($item,[
'action' => ['BatchController@update',$item->id],
'method' => 'PUT'
])
!!}

@include('admin.batches.form')


{!! Form::close() !!}

@stop