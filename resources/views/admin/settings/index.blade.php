@extends('admin.default')

@section('page-header')
Admin Settings
@stop

@section('content')
{!! Form::open([
'action' => ['SettingController@store']
])
!!}

<div class="row mB-40">
    <div class="col-md-6 col-lg-6">
        <div class="bgc-white p-20 bd mB-10">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!!
                    Form::mySelect($settings[0]->setting_name,$settings[0]->setting_name,['1'=>'Active','0'=>'Disabled'],$settings[0]->value,['class'=>'form-control
                    select2'])!!}
                    {!! Form::label($settings[1]->setting_name)!!}
                    {!!
                    Form::text($settings[1]->setting_name,$settings[1]->value,['class'=>'form-control','style'=>'margin-bottom:10px','required'])
                    !!}
                    {!! Form::label($settings[2]->setting_name)!!}
                    {!!
                    Form::number($settings[2]->setting_name,$settings[2]->value,['class'=>'form-control','style'=>'margin-bottom:10px'])
                    !!}
                    {!!
                    Form::mySelect($settings[3]->setting_name,$settings[3]->setting_name,['1'=>'Yes','0'=>'No'],$settings[3]->value,['class'=>'form-control
                    select2'])!!}
                    {!!
                    Form::mySelect($settings[4]->setting_name,$settings[4]->setting_name,['1'=>'Yes','0'=>'No'],$settings[4]->value,['class'=>'form-control
                    select2'])!!}
                    {!!
                    Form::mySelect($settings[5]->setting_name,$settings[5]->setting_name,['1'=>'Active','0'=>'Disabled'],$settings[5]->value,['class'=>'form-control
                    select2'])!!}
                    {!! Form::label($settings[6]->setting_name)!!}
                    {!!
                    Form::text($settings[6]->setting_name,$settings[6]->value,['class'=>'form-control','style'=>'margin-bottom:10px','required'])
                    !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Save</button>

    </div>
    <div class="col-md-6 col-lg-6">
        <div class="bd bgc-white p-20">
            <div class="layers">
                <!-- Widget Title -->
                <div class="layer w-100 mB-20">
                    <h6 class="lh-1 text-dark">Instructions</h6>
                </div>
            </div>
            <ul>
                @foreach ($instructions as $instruction)
                <li class="text-dark mB-10">{{$instruction}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>


{!! Form::close() !!}

@stop