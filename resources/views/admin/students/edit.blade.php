@extends('admin.default')

@section('page-header')
	Student <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['StudentController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Name') !!}
		
			{!! Form::myInput('number', 'attendence', 'Attendence') !!}

			{!! Form::mySelect('e1_id', 'Elective 1', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}
    
            {!! Form::mySelect('e2_id', 'Elective 2', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e3_id', 'Elective 3', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e4_id', 'Elective 4', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e5_id', 'Elective 5', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e6_id', 'Elective 6', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e7_id', 'Elective 7', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

			{!! Form::mySelect('e8_id', 'Elective 8', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

            {!! Form::mySelect('e9_id', 'Elective 9', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

			{!! Form::mySelect('e10_id', 'Elective 10', $electives, null, ['class' => 'form-control select2', 'placeholder' => 'None..']) !!}

		</div>  
	</div>
</div>

		<button type="submit" class="btn btn-primary">Update</button>
		
	{!! Form::close() !!}
	
@stop
