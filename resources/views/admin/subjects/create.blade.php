@extends('admin.default')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


@section('page-header')
Subjects <small>Add your new subject</small>
@stop

@section('content')
{!! Form::open([
'action' => ['SubjectController@store']
])
!!}

@include('admin.subjects.form')


{!! Form::close() !!}

@stop
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="course_name"]').change(function(){
            var course_id = $('select[name="course_name"').find(":selected").val();
            $.ajax({
                url: "/api/semester/" + course_id ,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    $('select[name="semester"]').empty();
                            $.each(data, function(key, value) {
                                for (let index = 1; index <= value; index++) {
                                    $('select[name="semester"]').append('<option value="'+ index +'">'+ index +'</option>');  
                                }
                            });
                }
            });
        });
    })
</script>